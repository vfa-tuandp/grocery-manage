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
        foreach ($data as $value) {
            $orderDetail = $this->purchaseReceiptDetailRepo->create(array_merge($value, ['purchase_receipt_id' => $purchaseReceiptId]));
            if($orderDetail->item->check_in_stock) {
                $orderDetail->item->increment('in_stock', $value['quantity']);
            };
        }
    }
}
