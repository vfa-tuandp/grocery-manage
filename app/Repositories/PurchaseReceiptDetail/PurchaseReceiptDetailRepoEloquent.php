<?php

namespace App\Repositories\PurchaseReceiptDetail;

use App\Models\PurchaseReceiptDetail;
use App\Repositories\MyBaseRepository;

/**
 * Class PurchaseReceiptDetailRepositoryEloquent
 * @package namespace App\Repositories;
 */
class PurchaseReceiptDetailRepoEloquent extends MyBaseRepository implements PurchaseReceiptDetailRepo
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PurchaseReceiptDetail::class;
    }
}
