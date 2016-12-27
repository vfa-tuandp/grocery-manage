<?php

namespace App\Services\Customer\Actions;

use App\Services\Customer\Tasks\FillDatatableTsk;

class FillDatatableByCompanyAct
{

    private $fillDatatableTsk;

    public function __construct(FillDatatableTsk $fillDatatableTsk)
    {
        $this->fillDatatableTsk = $fillDatatableTsk;
    }
    
    public function run()
    {
        $customerData = $this->fillDatatableTsk->byCompanyId();

        return $customerData;
    }
}
