<?php

namespace App\Services\Item\Tasks;

use App\Repositories\Order\OrderRepo;
use App\Repositories\PurchaseReceipt\PurchaseReceiptRepo;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;

class GetStockTsk
{
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
    public function __construct (OrderRepo $orderRepo, PurchaseReceiptRepo $purchaseReceiptRepo)
    {
        $this->orderRepo = $orderRepo;
        $this->purchaseReceiptRepo = $purchaseReceiptRepo;
    }
    
    public function run($request = null, $companyId = null)
    {
//        dd($request);
        $companyId = $companyId ?: auth()->user()->company_id;
        $refreshQuery = false;
        if (empty($request['action']) || $request['action'] == ['filter_cancel']) {//"action" only present when we do a filter
            $refreshQuery = true;
        }

        $orderQuery = $this->orderRepo->scopeQuery(
            function ($scope) use ($request, $companyId) {
                return $scope->leftJoin('customers', function($join) {
                    $join->on('orders.customer_id', '=', 'customers.id');
                })->leftJoin('order_details', function($join) {
                    $join->on('orders.id', '=', 'order_details.order_id');
                })->join('items', function($join) {
                    $join->on('items.id', '=', 'order_details.item_id');
                })->join('categories', function($join) {
                    $join->on('items.category_id', '=', 'categories.id');
                })->where('orders.company_id', '=', $companyId);
            }
        )
            ->makeQueryBuilder(
            [
                'datetime',
                'categories.name as category_name',
                'items.name as item_name',
                'items.unit as unit',
                'order_details.quantity',
                'customers.name as target_name',
                \DB::raw("'Bán' as kind")
            ]
        );

        $purchaseQuery = $this->purchaseReceiptRepo->scopeQuery(
            function ($scope) use ($request, $companyId) {
                return $scope->leftJoin('suppliers', function($join) {
                    $join->on('purchase_receipts.supplier_id', '=', 'suppliers.id');
                    })->leftJoin('purchase_receipt_details', function($join) {
                         $join->on('purchase_receipts.id', '=', 'purchase_receipt_details.purchase_receipt_id');
                    })->join('items', function($join) {
                        $join->on('items.id', '=', 'purchase_receipt_details.item_id');
                    })->join('categories', function($join) {
                        $join->on('items.category_id', '=', 'categories.id');
                    })->where('purchase_receipts.company_id', '=', $companyId);
            })->makeQueryBuilder(
             [
                 'datetime',
                 'categories.name as category_name',
                 'items.name as item_name',
                 'items.unit as unit',
                 'purchase_receipt_details.quantity',
                 'suppliers.name as target_name',
                 \DB::raw("'Nhập' as kind")
             ]
         );

        $query = $this->getQuery($refreshQuery, $request, $orderQuery, $purchaseQuery);

//
//        $totalQuery = clone $query;
//
//        $query->with('customer')->orderBy('orders.id', 'desc');
//
//        $allTotal = $totalQuery->select([\DB::raw('sum(total) as all_total')])->get()->toArray()[0]['all_total'];

        $result = Datatables::of($query)
                ->editColumn('datetime', function ($query) {
                    return $query->datetime->format('d/m/Y H:i:s');
                })
                ->editColumn('quantity', function ($query) {
                    return $query->quantity . ' ' . $query->unit;
                })
                ->addColumn('detail', function ($query) {
                    return '<td><a class="detail" href="javascript:;"><i class="glyphicon glyphicon-th-list"></i></a></td>';
                })
//                ->with(['all_total' => number_format($allTotal, 0, ",", ".") . ' đ'])
                ->make(true);

        return $result;
    }

    private function filterParams(&$query, $request)
    {
        if (!empty($request['target_name'])) {
            if ($request['kind'] == [1]) {
                $query->where('customer_name', 'like', '%' . $request['target_name'] . '%');
            }
            if ($request['kind'] == [2]) {
                $query->where('supplier_name', 'like', '%' . $request['target_name'] . '%');
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

    private function getQuery($refreshQuery, $request, $orderQuery, $purchaseQuery) {
//        dd($refreshQuery, $request);
        if (!$refreshQuery && empty($request['kind'])) {
            return $orderQuery->unionAll($purchaseQuery->where('items.id', '<', '0'))->where('items.id', '<', '0');
        }

        if (!$refreshQuery && $request['kind'] == [1, 2]) {
            $this->filterParams($orderQuery, $request);
            $this->filterParams($purchaseQuery, $request);
            return $orderQuery->unionAll($purchaseQuery);
        }

        if (!$refreshQuery && $request['kind'] == [2]) {
            $this->filterParams($orderQuery, $request);
            return $orderQuery;

        }

        if (!$refreshQuery && $request['kind'] == [1]) {
            $this->filterParams($purchaseQuery, $request);
            return $purchaseQuery;
        }

        if ($refreshQuery) {
            return $orderQuery->unionAll($purchaseQuery);
        }
    }
}
