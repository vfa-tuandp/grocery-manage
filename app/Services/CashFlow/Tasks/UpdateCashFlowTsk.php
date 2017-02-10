<?php

namespace App\Services\CashFlow\Tasks;

use App\Repositories\CashFlow\CashFlowRepo;

class UpdateCashFlowTsk
{
    /**
     * @var CashFlowRepo
     */
    private $cashFlowRepo;

    public function __construct(CashFlowRepo $cashFlowRepo)
    {
        $this->cashFlowRepo = $cashFlowRepo;
    }

    public function run($cashFlowId, $data)
    {
        return $this->cashFlowRepo->update($data, $cashFlowId);
    }
}
