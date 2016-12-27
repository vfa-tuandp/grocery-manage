<?php

namespace App\Services\Customer\Tasks;

use App\Repositories\Customer\CustomerRepo;
use Yajra\Datatables\Datatables;

class FillDatatableTsk
{
    const COLUMNS = [
        'id',
        'name',
        'company',
        'email',
        'phone',
        'address',
    ];

    /**
     * @var CustomerRepo
     */
    private $customerRepo;

    public function __construct(CustomerRepo $customerRepo)
    {
        $this->customerRepo = $customerRepo;
    }

    public function byCompanyId($companyId = null)
    {
        $companyId = $companyId ? : auth()->user()->company_id;
        $query = $this->customerRepo->scopeQuery(function ($scope) use ($companyId) {
            return $scope->where('company_id', $companyId)->orderBy('created_at', 'desc');
        })->makeQueryBuilder(self::COLUMNS);
        $result = Datatables::of($query)
            ->addColumn('edit', '<td><a class="edit" href="javascript:;">Edit </a></td>')
            ->addColumn('delete', '<td><a class="delete" href="javascript:;">Delete </a></td>')
            ->make();
        return $result;
    }
}
