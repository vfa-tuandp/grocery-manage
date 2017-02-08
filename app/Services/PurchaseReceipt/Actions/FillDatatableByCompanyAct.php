<?php

namespace App\Services\PurchaseReceipt\Actions;

use App\Services\PurchaseReceipt\Tasks\FillDatatableTsk;

class FillDatatableByCompanyAct
{

    private $fillDatatableTsk;

    public function __construct(FillDatatableTsk $fillDatatableTsk)
    {
        $this->fillDatatableTsk = $fillDatatableTsk;
    }
    
    public function run($request)
    {
        $purchaseReceiptData = $this->fillDatatableTsk->byCompanyId($request);

        return $purchaseReceiptData;
    }
}
