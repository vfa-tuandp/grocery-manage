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

        return $this->purchaseReceiptRepo->update($data, $id);
    }
}
