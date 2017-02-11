<?php

namespace App\Services\CashFlow\Actions;

use App\Services\CashFlow\Tasks\FindCashFlowTsk;

class EditCashFlowAct
{
    private $findCashFlowTsk;

    public function __construct(FindCashFlowTsk $findCashFlowTsk)
    {
        $this->findCashFlowTsk = $findCashFlowTsk;
    }
    
    public function run($cashFlowId)
    {
        return $this->findCashFlowTsk->run($cashFlowId);
    }
}
