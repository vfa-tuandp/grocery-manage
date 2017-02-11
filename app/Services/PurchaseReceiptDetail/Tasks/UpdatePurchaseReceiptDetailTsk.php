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
                $dataToUpdate = reset($dataToUpdate);
                if ($existsPurchaseReceiptDetail->item->check_in_stock) {
                    $existsPurchaseReceiptDetail->item->in_stock = $existsPurchaseReceiptDetail->item->in_stock
                        - $existsPurchaseReceiptDetail->quantity
                        + $dataToUpdate['quantity'];

                    $existsPurchaseReceiptDetail->item->save();
                }
                $existsPurchaseReceiptDetail->update($dataToUpdate);
                continue;
            }

            if ($existsPurchaseReceiptDetail->item->check_in_stock) {
                $existsPurchaseReceiptDetail->item->decrement('in_stock', $existsPurchaseReceiptDetail->quantity);
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
            $purchaseReceiptDetail = $purchaseReceipt->purchaseReceiptDetails()->create($data);
            if ($purchaseReceiptDetail->item->check_in_stock) {
                $purchaseReceiptDetail->item->increment('in_stock', $data['quantity']);
            };
        }
    }
}
