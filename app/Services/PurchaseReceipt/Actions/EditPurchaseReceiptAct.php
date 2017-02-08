<?php

namespace App\Services\PurchaseReceipt\Actions;

use App;
use App\Services\Category\Tasks\ListCategoryTsk;
use App\Services\Supplier\Tasks\ListSupplierTsk;
use App\Services\PurchaseReceipt\Tasks\GetPurchaseReceiptTsk;

class EditPurchaseReceiptAct
{
    /**
     * @var ListCategoryTsk
     */
    private $listCategoryTsk;
    /**
     * @var ListSupplierTsk
     */
    private $listSupplierTsk;
    /**
     * @var GetPurchaseReceiptTsk
     */
    private $getPurchaseReceiptTsk;

    public function __construct(ListCategoryTsk $listCategoryTsk, ListSupplierTsk $listSupplierTsk, GetPurchaseReceiptTsk $getPurchaseReceiptTsk)
    {
        $this->listCategoryTsk = $listCategoryTsk;
        $this->listSupplierTsk = $listSupplierTsk;
        $this->getPurchaseReceiptTsk = $getPurchaseReceiptTsk;
    }

    public function run($purchaseReceiptId)
    {
        $listCategory = $this->listCategoryTsk->byCompanyId();
        $listSupplier = $this->listSupplierTsk->byCompanyId();
        
        $currentPurchaseReceipt = $this->getPurchaseReceiptTsk->byId($purchaseReceiptId, ['purchaseReceiptDetails', 'purchaseReceiptDetails.item.category']);
        if ($currentPurchaseReceipt->company_id != auth()->user()->company_id) {
            App::abort(404);
        }
        
        return [$listCategory, $listSupplier, $currentPurchaseReceipt];
    }
}
