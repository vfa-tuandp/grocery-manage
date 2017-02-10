<?php

namespace App\Services\PurchaseReceipt\Tasks;

use App\Repositories\PurchaseReceipt\PurchaseReceiptRepo;

class UpdatePurchaseReceiptTsk
{
    /**
     * @var PurchaseReceiptRepo
     */
    private $purchaseReceiptRepo;

    public function __construct(PurchaseReceiptRepo $purchaseReceiptRepo)
    {
        $this->purchaseReceiptRepo = $purchaseReceiptRepo;
    }

    public function run($data, $id)
    {
        $data['datetime'] = parseFromDateTimePicker($data['datetime']);

        $purchaseReceipt = $this->purchaseReceiptRepo->update($data, $id);

        $cashFlow = $purchaseReceipt->cashFlow;
        $cashFlow->datetime = $data['datetime'];
        $cashFlow->value = $data['total'];
        $cashFlow->save();

        return $purchaseReceipt;
    }
}
