<?php

namespace App\Services\PurchaseReceipt\Tasks;

use App\Models\CashFlow;
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

        $newPurchase = $this->purchaseReceiptRepo->create($data);

        $cashFlowData = [
            'datetime' => $data['datetime'],
            'type' => CashFlow::CHI,
            'content' => 'Nhập hàng',
            'value' => $data['total'],
            'company_id' => $data['company_id']
        ];
        $newPurchase->cashFlow()->create($cashFlowData);

        return $newPurchase;
    }
}
