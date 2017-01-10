<?php

namespace App\Services\Supplier\Actions;

use App\Services\Supplier\Tasks\FillDatatableTsk;

class FillDatatableByCompanyAct
{

    private $fillDatatableTsk;

    public function __construct(FillDatatableTsk $fillDatatableTsk)
    {
        $this->fillDatatableTsk = $fillDatatableTsk;
    }
    
    public function run()
    {
        $supplierData = $this->fillDatatableTsk->byCompanyId();

        return $supplierData;
    }
}
