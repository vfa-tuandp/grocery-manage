<?php

namespace App\Services\PurchaseReceipt\Actions;

use App\Services\PurchaseReceipt\Tasks\UpdatePurchaseReceiptTsk;
use App\Services\PurchaseReceiptDetail\Tasks\UpdatePurchaseReceiptDetailTsk;

class UpdatePurchaseReceiptAct
{

    /**
     * @var UpdatePurchaseReceiptTsk
     */
    private $updatePurchaseReceiptTsk;
    /**
     * @var UpdatePurchaseReceiptDetailTsk
     */
    private $updatePurchaseReceiptDetailTsk;

    public function __construct(UpdatePurchaseReceiptTsk $updatePurchaseReceiptTsk, UpdatePurchaseReceiptDetailTsk $updatePurchaseReceiptDetailTsk)
    {
        $this->updatePurchaseReceiptTsk = $updatePurchaseReceiptTsk;
        $this->updatePurchaseReceiptDetailTsk = $updatePurchaseReceiptDetailTsk;
    }
    
    public function run($data, $purchaseReceiptId)
    {
        try {
            \DB::beginTransaction();
            $updatedPurchaseReceipt = $this->updatePurchaseReceiptTsk->run($data, $purchaseReceiptId);
            $this->updatePurchaseReceiptDetailTsk->run($data['items'], $updatedPurchaseReceipt);
            \DB::commit();
            return true;
        } catch (\Exception $e) {
            \DB::rollBack();
            return false;
        }
    }
}
