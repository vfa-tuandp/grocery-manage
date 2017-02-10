<?php

namespace App\Services\CashFlow\Actions;

use App\Models\CashFlow;
use App\Services\CashFlow\Tasks\FillCashFlowTsk;

class FillCashFlowAct
{
    /**
     * @var FillCashFlowTsk
     */
    private $fillCashFlowTsk;

    public function __construct (FillCashFlowTsk $fillCashFlowTsk)
    {
        $this->fillCashFlowTsk = $fillCashFlowTsk;
    }
    
    public function run($request)
    {
        return $this->fillCashFlowTsk->run($request);
    }
}
