<?php

namespace App\Services\PurchaseReceipt\Actions;

use App\Services\PurchaseReceipt\Tasks\GetPurchaseReceiptDetailTsk;

class GetPurchaseReceiptDetailByPurchaseReceiptIdAct
{
    /**
     * @var GetPurchaseReceiptDetailTsk
     */
    private $getPurchaseReceiptDetailTsk;

    public function __construct(GetPurchaseReceiptDetailTsk $getPurchaseReceiptDetailTsk)
    {
        $this->getPurchaseReceiptDetailTsk = $getPurchaseReceiptDetailTsk;
    }
    
    public function run($purchaseReceiptId)
    {
        return $this->getPurchaseReceiptDetailTsk->byPurchaseReceiptId($purchaseReceiptId, 'item');
    }
}
