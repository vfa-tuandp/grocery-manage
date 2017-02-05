<?php

namespace App\Services\Order\Tasks;

use App\Repositories\Order\OrderRepo;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;

class FillDatatableTsk
{
    /**
     * @var OrderRepo
     */
    private $orderRepo;

    public function __construct(OrderRepo $orderRepo)
    {
        $this->orderRepo = $orderRepo;
    }

    public function byCompanyId($request = null, $companyId = null)
    {
        $companyId = $companyId ?: auth()->user()->company_id;
        \DB::enableQueryLog();
        $query = $this->orderRepo->scopeQuery(
            function ($scope) use ($request, $companyId) {
                return $scope->where('orders.company_id', $companyId);
            }
        )->makeQueryBuilder(
            [
                'orders.id',
                'datetime',
                'other_cost',
                'reduction',
                'note',
                'vat',
                'total',
                'customer_id',
                'orders.created_at'
            ]
        );

        $this->filterParams($query, $request);

        $totalQuery = clone $query;

        $query->with('customer')->orderBy('orders.id', 'desc');

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
                ->addColumn(
                    'detail',
                    '<td><a class="detail" href="javascript:;"><i class="glyphicon glyphicon-th-list"></i></a></td>' .
                    '&nbsp;&nbsp;<td><a class="edit" href="javascript:;"><i class="glyphicon glyphicon glyphicon-pencil"></i></a></td>'
                )
                ->with(['all_total' => number_format($allTotal, 0, ",", ".") . ' đ'])
                ->make(true);

        return $result;
    }

    private function filterParams(&$query, $request)
    {
        if (!empty($request['customer_name'])) {
            $query->whereHas('customer', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request['customer_name'] . '%');
            });
        }

        if (!empty($request['order_id'])) {
            $query->where('orders.id', '=', $request['order_id']);
        }

        if (!empty($request['order_date_from'])) {
            $query->where('datetime', '>=', Carbon::createFromFormat('d/m/Y', $request['order_date_from']));
        }

        if (!empty($request['order_date_to'])) {
            $query->where('datetime', '<=', Carbon::createFromFormat('d/m/Y', $request['order_date_to']));
        }

        return $query;
    }
}
