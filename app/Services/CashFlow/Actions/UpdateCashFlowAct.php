<?php

namespace App\Services\CashFlow\Actions;

use App\Models\CashFlow;
use App\Services\CashFlow\Tasks\UpdateCashFlowTsk;

class UpdateCashFlowAct
{
    private $updateCashFlowTsk;

    public function __construct(UpdateCashFlowTsk $updateCashFlowTsk)
    {
        $this->updateCashFlowTsk = $updateCashFlowTsk;
    }

    public function run($cashFlowId, $data)
    {
        $data['datetime'] = parseFromDateTimePicker($data['datetime']);
        $data['type'] = !empty($data['type']) ? CashFlow::CHI : CashFlow::THU;

        $this->updateCashFlowTsk->run($cashFlowId, $data);
    }
}
