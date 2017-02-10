<?php

namespace App\Services\CashFlow\Tasks;

use App\Repositories\CashFlow\CashFlowRepo;

class StoreCashFlowTsk
{
    /**
     * @var CashFlowRepo
     */
    private $cashFlowRepo;

    public function __construct(CashFlowRepo $cashFlowRepo)
    {
        $this->cashFlowRepo = $cashFlowRepo;
    }

    public function run($data)
    {
        return $this->cashFlowRepo->create($data);
    }
}
