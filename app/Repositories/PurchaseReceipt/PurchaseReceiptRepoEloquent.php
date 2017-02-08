<?php

namespace App\Repositories\PurchaseReceipt;

use App\Models\PurchaseReceipt;
use App\Repositories\MyBaseRepository;

/**
 * Class PurchaseReceiptRepositoryEloquent
 * @package namespace App\Repositories;
 */
class PurchaseReceiptRepoEloquent extends MyBaseRepository implements PurchaseReceiptRepo
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PurchaseReceipt::class;
    }
}
