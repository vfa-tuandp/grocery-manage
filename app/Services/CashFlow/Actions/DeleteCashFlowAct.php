<?php

namespace App\Services\CashFlow\Actions;

use App\Services\CashFlow\Tasks\DeleteCashFlowTsk;

class DeleteCashFlowAct
{
    private $deleteCashFlowTsk;

    public function __construct (DeleteCashFlowTsk $deleteCashFlowTsk)
    {
        $this->deleteCashFlowTsk = $deleteCashFlowTsk;
    }
    
    public function run($cashFlowId)
    {
        return $this->deleteCashFlowTsk->run($cashFlowId);
    }
}
