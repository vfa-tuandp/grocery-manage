<?php

namespace App\Services\PurchaseReceipt\Tasks;

use App\Repositories\PurchaseReceipt\PurchaseReceiptRepo;

class GetPurchaseReceiptTsk
{
    /**
     * @var PurchaseReceiptRepo
     */
    private $purchaseReceiptRepo;

    public function __construct(PurchaseReceiptRepo $purchaseReceiptRepo)
    {
        $this->purchaseReceiptRepo = $purchaseReceiptRepo;
    }

    public function byId($purchaseReceiptId, $relations = [])
    {
        if (!empty($relations)) {
            return $this->purchaseReceiptRepo->with($relations)->find($purchaseReceiptId);
        }
        return $this->purchaseReceiptRepo->find($purchaseReceiptId);
    }
}
