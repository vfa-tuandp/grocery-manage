<?php

namespace App\Services\CashFlow\Actions;

use App\Models\CashFlow;
use App\Services\CashFlow\Tasks\StoreCashFlowTsk;

class StoreCashFlowAct
{
    /**
     * @var StoreCashFlowTsk
     */
    private $storeCashFlowTsk;

    public function __construct(StoreCashFlowTsk $storeCashFlowTsk)
    {
        $this->storeCashFlowTsk = $storeCashFlowTsk;
    }

    public function run($data)
    {
        $data['datetime'] = parseFromDateTimePicker($data['datetime']);
        $data['company_id'] = auth()->user()->company_id;
        $data['type'] = !empty($data['type']) ? CashFlow::CHI : CashFlow::THU;

        $this->storeCashFlowTsk->run($data);
    }
}
