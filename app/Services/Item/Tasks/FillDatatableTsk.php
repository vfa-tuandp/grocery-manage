<?php

namespace App\Services\Item\Tasks;

use App\Repositories\Item\ItemRepo;
use Yajra\Datatables\Datatables;

class FillDatatableTsk
{
    /**
     * @var ItemRepo
     */
    private $itemRepo;

    public function __construct(ItemRepo $itemRepo)
    {
        $this->itemRepo = $itemRepo;
    }

    public function byCompanyId($companyId = null)
    {
        $companyId = $companyId ? : auth()->user()->company_id;
        $query = $this->itemRepo->with('category')
            ->scopeQuery(function ($scope) use ($companyId) {
            return $scope->where('company_id', $companyId)
                ->orderBy('category_id', 'desc')
                ->orderBy('created_at', 'desc');
        })->makeQueryBuilder();

        $result = Datatables::of($query)
            ->addColumn('edit', '<td><a class="edit" href="javascript:;">Edit </a></td>')
            ->addColumn('delete', '<td><a class="delete" href="javascript:;">Delete </a></td>')
            ->make(true);
        return $result;
    }
}
