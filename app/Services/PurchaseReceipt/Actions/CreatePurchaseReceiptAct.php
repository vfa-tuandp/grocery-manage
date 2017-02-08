<?php

namespace App\Services\PurchaseReceipt\Actions;

use App\Services\Category\Tasks\ListCategoryTsk;
use App\Services\Supplier\Tasks\ListSupplierTsk;

class CreatePurchaseReceiptAct
{
    /**
     * @var ListCategoryTsk
     */
    private $listCategoryTsk;
    /**
     * @var ListSupplierTsk
     */
    private $listSupplierTsk;

    public function __construct(ListCategoryTsk $listCategoryTsk, ListSupplierTsk $listSupplierTsk)
    {
        $this->listCategoryTsk = $listCategoryTsk;
        $this->listSupplierTsk = $listSupplierTsk;
    }

    public function run()
    {
        $listCategory = $this->listCategoryTsk->byCompanyId();
        $listSupplier = $this->listSupplierTsk->byCompanyId();

        return [$listCategory, $listSupplier];
    }
}
