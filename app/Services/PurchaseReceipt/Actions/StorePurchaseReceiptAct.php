<?php

namespace App\Services\PurchaseReceipt\Actions;

use App\Services\PurchaseReceiptDetail\Tasks\CreatePurchaseReceiptDetailTsk;
use App\Services\PurchaseReceipt\Tasks\CreatePurchaseReceiptTsk;

class StorePurchaseReceiptAct
{

    /**
     * @var CreatePurchaseReceiptTsk
     */
    private $createPurchaseReceiptTsk;
    /**
     * @var CreatePurchaseReceiptDetailTsk
     */
    private $createPurchaseReceiptDetailTsk;

    public function __construct(CreatePurchaseReceiptTsk $createPurchaseReceiptTsk, CreatePurchaseReceiptDetailTsk $createPurchaseReceiptDetailTsk)
    {
        $this->createPurchaseReceiptTsk = $createPurchaseReceiptTsk;
        $this->createPurchaseReceiptDetailTsk = $createPurchaseReceiptDetailTsk;
    }
    
    public function run($data)
    {
        try {
            \DB::beginTransaction();
            $newPurchaseReceipt = $this->createPurchaseReceiptTsk->run($data);
            $this->createPurchaseReceiptDetailTsk->run($data['items'], $newPurchaseReceipt->id);
            \DB::commit();
            return true;
        } catch (\Exception $e) {
            \DB::rollBack();
            return false;
        }
    }
}
