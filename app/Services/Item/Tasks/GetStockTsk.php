<?php

namespace App\Services\Item\Tasks;

use App\Repositories\Order\OrderRepo;
use App\Repositories\PurchaseReceipt\PurchaseReceiptRepo;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;

class GetStockTsk
{
    private $quantityIn = 0;
    private $quantityOut = 0;

    /**
     * @var OrderRepo
     */
    private $orderRepo;
    /**
     * @var PurchaseReceiptRepo
     */
    private $purchaseReceiptRepo;

    /**
     * GetStockTsk constructor.
     *
     * @param OrderRepo           $orderRepo
     * @param PurchaseReceiptRepo $purchaseReceiptRepo
     */
    public function __construct(OrderRepo $orderRepo, PurchaseReceiptRepo $purchaseReceiptRepo)
    {
        $this->orderRepo = $orderRepo;
        $this->purchaseReceiptRepo = $purchaseReceiptRepo;
    }
    
    public function run($request = null, $companyId = null)
    {
        $companyId = $companyId ?: auth()->user()->company_id;
        $refreshQuery = false;
        if (empty($request['action']) || $request['action'] == ['filter_cancel']) {//"action" only present when we do a filter
            $refreshQuery = true;
        }

        $orderQuery = $this->orderRepo->getOrderQuery($companyId);

        $purchaseQuery = $this->purchaseReceiptRepo->getPurchaseQuery($companyId);

        $prepareQuery = $this->getQuery($refreshQuery, $request, $orderQuery, $purchaseQuery);
        $querySql = $prepareQuery->toSql();
        $query = \DB::table(\DB::raw("($querySql) as a"))
            ->mergeBindings($prepareQuery)
            ->orderBy('datetime', 'desc');

        $result = Datatables::of($query)
                ->editColumn('datetime', function ($query) {
                    return Carbon::parse($query->datetime)->format('d/m/Y H:i:s');
                })
                ->editColumn('quantity', function ($query) {
                    return $query->quantity . ' ' . $query->unit;
                })
                ->addColumn('detail', function ($query) {
                    return '<td><a class="detail" href="javascript:;"><i class="glyphicon glyphicon-th-list"></i></a></td>';
                })
                ->with(['quantity_in' => (int) $this->quantityIn, 'quantity_out' => (int) $this->quantityOut])
                ->make(true);

        return $result;
    }

    private function filterParams(&$query, $request)
    {
        if (!empty($request['target_name'])) {
            if ($request['kind'] == [2]) {
                $query->where('customers.name', 'like', '%' . $request['target_name'] . '%');
            }
            if ($request['kind'] == [1]) {
                $query->where('suppliers.name', 'like', '%' . $request['target_name'] . '%');
            }
        }

        if (!empty($request['category_name'])) {
            $query->where('categories.name', 'like', '%' . $request['category_name'] . '%');
        }

        if (!empty($request['item_name'])) {
            $query->where('items.name', 'like', '%' . $request['item_name'] . '%');
        }

        if (!empty($request['date_from'])) {
            $query->where('datetime', '>=', Carbon::createFromFormat('d/m/Y', $request['date_from'])->startOfDay());
        }

        if (!empty($request['date_to'])) {
            $query->where('datetime', '<=', Carbon::createFromFormat('d/m/Y', $request['date_to'])->endOfDay());
        }

        return $query;
    }

    private function getQuery($refreshQuery, $request, $orderQuery, $purchaseQuery)
    {
        if (!$refreshQuery && empty($request['kind'])) {
            return $orderQuery->unionAll($purchaseQuery->where('items.id', '<', '0'))->where('items.id', '<', '0');
        }

        if (!$refreshQuery && $request['kind'] == [1, 2]) {
            $this->filterParams($orderQuery, $request);
            $orderQuery->where('customers.name', 'like', '%' . $request['target_name'] . '%');
            $quantityCount = clone $orderQuery;
            $this->quantityOut = $quantityCount->select(\DB::raw("sum(quantity) as q"))->first()->q;
            $this->filterParams($purchaseQuery, $request);
            $purchaseQuery->where('suppliers.name', 'like', '%' . $request['target_name'] . '%');
            $quantityCount = clone $purchaseQuery;
            $this->quantityIn = $quantityCount->select(\DB::raw("sum(quantity) as q"))->first()->q;
            return $orderQuery->unionAll($purchaseQuery);
        }

        if (!$refreshQuery && $request['kind'] == [2]) {
            $this->filterParams($orderQuery, $request);
            $quantityCount = clone $orderQuery;
            $this->quantityOut = $quantityCount->select(\DB::raw("sum(quantity) as q"))->first()->q;
            return $orderQuery;
        }

        if (!$refreshQuery && $request['kind'] == [1]) {
            $this->filterParams($purchaseQuery, $request);
            $quantityCount = clone $purchaseQuery;
            $this->quantityIn = $quantityCount->select(\DB::raw("sum(quantity) as q"))->first()->q;
            return $purchaseQuery;
        }

        if ($refreshQuery) {
            $quantityCount = clone $orderQuery;
            $this->quantityOut = $quantityCount->select(\DB::raw("sum(quantity) as q"))->first()->q;

            $quantityCount = clone $purchaseQuery;
            $this->quantityIn = $quantityCount->select(\DB::raw("sum(quantity) as q"))->first()->q;
            return $orderQuery->unionAll($purchaseQuery);
        }
    }
}
