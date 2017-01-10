<?php

namespace App\Services\Supplier\Tasks;

use App\Repositories\Supplier\SupplierRepo;
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
     * @var SupplierRepo
     */
    private $supplierRepo;

    public function __construct(SupplierRepo $supplierRepo)
    {
        $this->supplierRepo = $supplierRepo;
    }

    public function byCompanyId($companyId = null)
    {
        $companyId = $companyId ? : auth()->user()->company_id;
        $query = $this->supplierRepo->scopeQuery(function ($scope) use ($companyId) {
            return $scope->where('company_id', $companyId)->orderBy('created_at', 'desc');
        })->makeQueryBuilder(self::COLUMNS);
        $result = Datatables::of($query)
            ->addColumn('edit', '<td><a class="edit" href="javascript:;">Edit </a></td>')
            ->addColumn('delete', '<td><a class="delete" href="javascript:;">Delete </a></td>')
            ->make();
        return $result;
    }
}
