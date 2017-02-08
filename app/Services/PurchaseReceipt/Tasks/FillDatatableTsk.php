<?php

namespace App\Services\PurchaseReceipt\Tasks;

use App\Repositories\PurchaseReceipt\PurchaseReceiptRepo;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;

class FillDatatableTsk
{
    /**
     * @var PurchaseReceiptRepo
     */
    private $purchaseReceiptRepo;

    public function __construct(PurchaseReceiptRepo $purchaseReceiptRepo)
    {
        $this->purchaseReceiptRepo = $purchaseReceiptRepo;
    }

    public function byCompanyId($request = null, $companyId = null)
    {
        $companyId = $companyId ?: auth()->user()->company_id;
        \DB::enableQueryLog();
        $query = $this->purchaseReceiptRepo->scopeQuery(
            function ($scope) use ($request, $companyId) {
                return $scope->where('purchase_receipts.company_id', $companyId);
            }
        )->makeQueryBuilder(
            [
                'purchase_receipts.id',
                'datetime',
                'other_cost',
                'reduction',
                'note',
                'vat',
                'total',
                'supplier_id',
                'purchase_receipts.created_at'
            ]
        );

        $this->filterParams($query, $request);

        $totalQuery = clone $query;

        $query->with('supplier')->orderBy('purchase_receipts.id', 'desc');

        $allTotal = $totalQuery->select([\DB::raw('sum(total) as all_total')])->get()->toArray()[0]['all_total'];

        $result = Datatables::of($query)
                ->editColumn('datetime', function ($query) {
                    return $query->created_at->format('d/m/Y H:i:s');
                })
                ->editColumn('vat', function ($query) {
                    return $query->vat ? 'Có' : 'Không';
                })
                ->editColumn('total', function ($query) {
                    return number_format($query->total, 0, ",", ".") . ' đ';
                })
                ->addColumn('detail', function ($query) {
                    return '<td><a class="detail" href="javascript:;"><i class="glyphicon glyphicon-th-list"></i></a></td>' .
                    '&nbsp;&nbsp;<td><a class="edit" href="/purchaseReceipt/' . $query->id . '/edit"><i class="glyphicon glyphicon glyphicon-pencil"></i></a></td>';
                })
                ->with(['all_total' => number_format($allTotal, 0, ",", ".") . ' đ'])
                ->make(true);

        return $result;
    }

    private function filterParams(&$query, $request)
    {
        if (!empty($request['supplier_name'])) {
            $query->whereHas('supplier', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request['supplier_name'] . '%');
            });
        }

        if (!empty($request['purchase_receipt_id'])) {
            $query->where('purchase_receipts.id', '=', $request['purchase_receipt_id']);
        }

        if (!empty($request['purchase_date_from'])) {
            $query->where('datetime', '>=', Carbon::createFromFormat('d/m/Y', $request['purchase_date_from'])->startOfDay());
        }

        if (!empty($request['purchase_date_to'])) {
            $query->where('datetime', '<=', Carbon::createFromFormat('d/m/Y', $request['purchase_date_to'])->endOfDay());
        }

        return $query;
    }
}
