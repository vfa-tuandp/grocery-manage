<?php

namespace App\Services\Order\Tasks;

use App\Repositories\Order\OrderRepo;
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
        $companyId = $companyId ? : auth()->user()->company_id;

        $query = $this->orderRepo->with('customer')
            ->scopeQuery(function ($scope) use ($companyId) {
                $scope->select([]);
                return $scope->where('orders.company_id', $companyId);
            })->makeQueryBuilder(['orders.id', 'customers.name', 'datetime', 'other_cost', 'reduction', 'note', 'vat', 'total', 'customer_id']);

        $result = Datatables::of($query)
//            ->addColumn('edit', '<td><a class="edit" href="javascript:;">Edit </a></td>')
//            ->addColumn('delete', '<td><a class="delete" href="javascript:;">Delete </a></td>')
            ->make(true);
        return $result;
    }
}
