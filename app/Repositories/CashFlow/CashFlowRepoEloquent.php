<?php

namespace App\Repositories\CashFlow;

use App\Models\CashFlow;
use App\Repositories\MyBaseRepository;

/**
 * Class ItemRepositoryEloquent
 * @package namespace App\Repositories;
 */
class CashFlowRepoEloquent extends MyBaseRepository implements CashFlowRepo
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CashFlow::class;
    }

    public function deleteReceipt($receiptId, $type)
    {
        $this->model->where('cashflowable_type', '=', $type)
                    ->where('cashflowable_id', '=', $receiptId)
                    ->delete();
    }
}
