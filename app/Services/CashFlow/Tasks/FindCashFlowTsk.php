<?php

namespace App\Services\CashFlow\Tasks;

use App;
use App\Repositories\CashFlow\CashFlowRepo;

class FindCashFlowTsk
{
    /**
     * @var CashFlowRepo
     */
    private $cashFlowRepo;

    public function __construct(CashFlowRepo $cashFlowRepo)
    {
        $this->cashFlowRepo = $cashFlowRepo;
    }

    public function run($cashFlowId)
    {
        $cashflow = $this->cashFlowRepo->find($cashFlowId);
        if ($cashflow->cashflowable_id) {
            App::abort(404);
        }
        return $cashflow;
    }
}
