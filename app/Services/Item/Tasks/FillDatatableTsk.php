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
                return $scope->where('items.company_id', $companyId)
                ->orderBy('items.created_at', 'desc');
            })->makeQueryBuilder();

        $result = Datatables::of($query)
            ->editColumn('in_stock', function ($query) {
                return $query->check_in_stock ? $query->in_stock : 'Không tính';
            })
            ->editColumn('price_in_hint', function ($query) {
                return number_format($query->price_in_hint, 0, ",", ".") . ' đ';
            })
            ->editColumn('price_out_hint', function ($query) {
                return number_format($query->price_out_hint, 0, ",", ".") . ' đ';
            })
            ->addColumn('edit', '<td><a class="edit" href="javascript:;">Edit </a></td>')
            ->addColumn('delete', '<td><a class="delete" href="javascript:;">Delete </a></td>')
            ->make(true);
        return $result;
    }
}
