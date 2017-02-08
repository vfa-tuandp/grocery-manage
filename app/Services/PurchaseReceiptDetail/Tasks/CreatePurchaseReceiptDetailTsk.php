<?php

namespace App\Services\PurchaseReceiptDetail\Tasks;

use App\Repositories\PurchaseReceiptDetail\PurchaseReceiptDetailRepo;

class CreatePurchaseReceiptDetailTsk
{
    /**
     * @var purchaseReceiptDetailRepo
     */
    private $purchaseReceiptDetailRepo;

    public function __construct(PurchaseReceiptDetailRepo $purchaseReceiptDetailRepo)
    {
        $this->purchaseReceiptDetailRepo = $purchaseReceiptDetailRepo;
    }

    public function run($data, $purchaseReceiptId)
    {
        return $this->purchaseReceiptDetailRepo->insertMany($data, true, ['purchase_receipt_id' => $purchaseReceiptId]);
    }
}
