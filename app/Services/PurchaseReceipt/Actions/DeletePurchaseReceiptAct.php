<?php

namespace App\Services\PurchaseReceipt\Actions;

use App\Services\PurchaseReceipt\Tasks\DeletePurchaseReceiptTsk;

class DeletePurchaseReceiptAct
{
    /**
     * @var DeletePurchaseReceiptTsk
     */
    private $deletePurchaseReceiptTsk;

    public function __construct(DeletePurchaseReceiptTsk $deletePurchaseReceiptTsk)
    {
        $this->deletePurchaseReceiptTsk = $deletePurchaseReceiptTsk;
    }

    public function run($purchaseReceiptId)
    {
        $this->deletePurchaseReceiptTsk->run($purchaseReceiptId);
    }
}
