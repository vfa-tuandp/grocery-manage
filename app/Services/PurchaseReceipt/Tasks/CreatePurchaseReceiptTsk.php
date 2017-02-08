<?php

namespace App\Services\PurchaseReceipt\Tasks;

use App\Repositories\PurchaseReceipt\PurchaseReceiptRepo;

class CreatePurchaseReceiptTsk
{
    /**
     * @var PurchaseReceiptRepo
     */
    private $purchaseReceiptRepo;

    public function __construct(PurchaseReceiptRepo $purchaseReceiptRepo)
    {
        $this->purchaseReceiptRepo = $purchaseReceiptRepo;
    }

    public function run($data)
    {
        $data['datetime'] = parseFromDateTimePicker($data['datetime']);
        $data['company_id'] = auth()->user()->company_id;

        return $this->purchaseReceiptRepo->create($data);
    }
}
