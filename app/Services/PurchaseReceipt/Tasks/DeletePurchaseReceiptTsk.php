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
        $this->purchaseReceiptRepo->delete($purchaseReceiptId);
        $this->cashFlowRepo->deleteReceipt($purchaseReceiptId, CashFlow::TYPE_PURCHASE);
    }
}
