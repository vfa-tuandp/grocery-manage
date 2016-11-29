<?php

namespace App\Services\Category\Tasks;

use App\Repositories\Category\CategoryRepo;
use Yajra\Datatables\Datatables;

class FillDatatableTsk
{
    /**
     * @var CategoryRepo
     */
    private $categoryRepo;

    public function __construct(CategoryRepo $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function byCompanyId($companyId = null)
    {
        $companyId = $companyId ? : auth()->user()->company_id;
        $query = $this->categoryRepo->scopeQuery(function ($scope) use ($companyId) {
            return $scope->where('company_id', $companyId)->orderBy('created_at', 'desc');
        })->makeQueryBuilder(['id', 'name', 'created_at', 'updated_at']);
        $result = Datatables::of($query)
            ->addColumn('edit', '<td><a class="edit" href="javascript:;">Edit </a></td>')
            ->addColumn('delete', '<td><a class="delete" href="javascript:;">Delete </a></td>')
            ->editColumn('created_at', function ($data) {
                return $data->created_at->format('d/m/Y');
            })
            ->editColumn('updated_at', function ($data) {
                return $data->updated_at->format('d/m/Y');
            })
            ->make();
        return $result;
    }
}
