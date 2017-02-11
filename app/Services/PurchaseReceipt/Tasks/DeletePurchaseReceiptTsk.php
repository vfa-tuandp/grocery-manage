<?php
namespace App\Services\PurchaseReceipt\Tasks;

use App\Models\CashFlow;
use App\Repositories\CashFlow\CashFlowRepo;
use App\Repositories\PurchaseReceipt\PurchaseReceiptRepo;

class DeletePurchaseReceiptTsk
{
    /**
     * @var PurchaseReceiptRepo
     */
    private $purchaseReceiptRepo;
    /**
     * @var CashFlowRepo
     */
    private $cashFlowRepo;

    public function __construct(PurchaseReceiptRepo $purchaseReceiptRepo, CashFlowRepo $cashFlowRepo)
    {
        $this->purchaseReceiptRepo = $purchaseReceiptRepo;
        $this->cashFlowRepo = $cashFlowRepo;
    }

    public function run($purchaseReceiptId)
    {
        $purchaseReceipt = $this->purchaseReceiptRepo->with(['purchaseReceiptDetails', 'purchaseReceiptDetails.item'])->find($purchaseReceiptId);

        foreach ($purchaseReceipt->purchaseReceiptDetails as $purchaseReceiptDetail) {
            if ($purchaseReceiptDetail->item->check_in_stock) {
                $purchaseReceiptDetail->item->decrement('in_stock', $purchaseReceiptDetail->quantity);
            }
        }

        $purchaseReceipt->delete();

        $this->cashFlowRepo->deleteReceipt($purchaseReceiptId, CashFlow::TYPE_PURCHASE);
    }
}
