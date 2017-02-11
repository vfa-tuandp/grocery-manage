<?php

namespace App\Services\CashFlow\Tasks;

use App;
use App\Repositories\CashFlow\CashFlowRepo;

class DeleteCashFlowTsk
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
        return $this->cashFlowRepo->delete($cashFlowId);
    }
}
