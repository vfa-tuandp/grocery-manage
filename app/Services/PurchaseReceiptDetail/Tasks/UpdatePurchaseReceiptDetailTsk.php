<?php

namespace App\Services\PurchaseReceiptDetail\Tasks;

use App\Repositories\PurchaseReceiptDetail\PurchaseReceiptDetailRepo;

class UpdatePurchaseReceiptDetailTsk
{
    /**
     * @var purchaseReceiptDetailRepo
     */
    private $purchaseReceiptDetailRepo;

    public function __construct(PurchaseReceiptDetailRepo $purchaseReceiptDetailRepo)
    {
        $this->purchaseReceiptDetailRepo = $purchaseReceiptDetailRepo;
    }

    public function run($data, $purchaseReceipt)
    {
        $existsPurchaseReceiptDetails = $purchaseReceipt->purchaseReceiptDetails;

        foreach ($existsPurchaseReceiptDetails as $existsPurchaseReceiptDetail) {
            $dataToUpdate = array_where($data, function ($key, $value) use ($existsPurchaseReceiptDetail) {
                return $value['id'] == $existsPurchaseReceiptDetail->id;
            });
            if ($dataToUpdate) {
                $existsPurchaseReceiptDetail->update(reset($dataToUpdate));
                continue;
            }
            $existsPurchaseReceiptDetail->delete();
        }
        $newPurchaseReceiptDetailData = array_where($data, function ($key, $value) {
            return $value['id'] == false;
        });
        if (empty($newPurchaseReceiptDetailData)) {
            return;
        }
        foreach ($newPurchaseReceiptDetailData as $data) {
            $purchaseReceipt->purchaseReceiptDetails()->create($data);
        }
    }
}
