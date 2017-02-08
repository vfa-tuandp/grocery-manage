<?php

namespace App\Services\PurchaseReceipt\Tasks;

use App\Repositories\PurchaseReceiptDetail\PurchaseReceiptDetailRepo;

class GetPurchaseReceiptDetailTsk
{
    /**
     * @var PurchaseReceiptDetailRepo
     */
    private $purchaseReceiptDetailRepo;

    public function __construct(PurchaseReceiptDetailRepo $purchaseReceiptDetailRepo)
    {
        $this->purchaseReceiptDetailRepo = $purchaseReceiptDetailRepo;
    }

    public function byPurchaseReceiptId($purchaseReceiptId, $relations = [])
    {
        if (!empty($relations)) {
            return $this->purchaseReceiptDetailRepo->with($relations)->findByField('purchase_receipt_id', $purchaseReceiptId);
        }
        return $this->purchaseReceiptDetailRepo->findByField('purchase_receipt_id', $purchaseReceiptId);
    }
}
