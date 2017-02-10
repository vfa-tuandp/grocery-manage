<?php

namespace App\Services\CashFlow\Tasks;

use App\Models\CashFlow;
use App\Repositories\CashFlow\CashFlowRepo;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;

class FillCashFlowTsk
{
    /**
     * @var CashFlowRepo
     */
    private $cashFlowRepo;
    private $totalOut;
    private $totalIn;

    public function __construct(CashFlowRepo $cashFlowRepo)
    {
        $this->cashFlowRepo = $cashFlowRepo;
    }

    public function run($request = null, $companyId = null)
    {
        $companyId = $companyId ?: auth()->user()->company_id;

        $refreshQuery = false;
        if (empty($request['action']) || $request['action'] == ['filter_cancel']) {//"action" only present when we do a filter
            $refreshQuery = true;
        }

        $baseQuery = $this->cashFlowRepo->scopeQuery(function ($scope) use ($companyId) {
           return $scope->where('company_id', '=', $companyId);
        })->makeQueryBuilder();

        $query = $this->getQuery($refreshQuery, $request, $baseQuery);

        $result = Datatables::of($query)
                            ->editColumn('datetime', function ($query) {
                                return $query->datetime->format('d/m/Y H:i:s');
                            })
                            ->editColumn('value', function ($query) {
                                return number_format($query->value, 0, ",", ".") . ' đ';
                            })
                            ->editColumn('type', function ($query) {
                                return $query->type ? 'Chi' : 'Thu';
                            })
                            ->addColumn('detail', function ($query) {
                                return $query->cashflowable_id ? '<td><a class="detail" href="javascript:;">Chi tiết #' . $query->cashflowable_id . '</a></td>' :
                                    '<td><a class="detail" href="javascript:;">Chỉnh sửa' . '</a></td>';
                            })
                            ->with(['total_in' => number_format($this->totalIn, 0, ",", "."), 'total_out' => number_format($this->totalOut, 0, ",", ".")])
                            ->make(true);

        return $result;
    }

    private function getQuery($refreshQuery, $request, &$baseQuery)
    {
        if (!$refreshQuery) {
            if (empty($request['type'])) {
                return $baseQuery->where('id', '<', '0');
            }


            if (!empty($request['content'])) {
                $baseQuery->where('content', 'like', '%' . $request['content'] . '%');
            }

            if (!empty($request['date_from'])) {
                $baseQuery->where('datetime', '>=', Carbon::createFromFormat('d/m/Y', $request['date_from'])->startOfDay());
            }

            if (!empty($request['date_to'])) {
                $baseQuery->where('datetime', '<=', Carbon::createFromFormat('d/m/Y', $request['date_to'])->endOfDay());
            }

            if ($request['type'] == [0]) {
                $baseQuery->where('type', '=', '0');
                $totalIn = clone $baseQuery;
                $this->totalIn = $totalIn->select([\DB::raw('sum(value) as ti')])->first()->ti;
            }

            if ($request['type'] == [1]) {
                $baseQuery->where('type', '=', '1');
                $totalOut = clone $baseQuery;
                $this->totalOut = $totalOut->select([\DB::raw('sum(value) as total_out')])->first()->total_out;
            }

            if ($request['type'] = [0, 1]) {
                $this->getTotal($baseQuery);
            }

            return $baseQuery;
        }
        $this->getTotal($baseQuery);
        return $baseQuery;
    }

    /**
     * @param $baseQuery
     */
    private function getTotal($baseQuery)
    {
        $totalIn = clone $baseQuery;
        $this->totalIn = $totalIn->select([\DB::raw('sum(value) as ti')])->where('type', '=', '0')->first()->ti;
        $totalOut = clone $baseQuery;
        $this->totalOut = $totalOut->select([\DB::raw('sum(value) as total_out')])->where('type', '=', '1')->first(
        )->total_out;
    }


}
