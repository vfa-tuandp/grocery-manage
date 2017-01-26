<?php

namespace App\Services\Order\Actions;

use App\Services\Order\Tasks\FillDatatableTsk;

class FillDatatableByCompanyAct
{

    private $fillDatatableTsk;

    public function __construct(FillDatatableTsk $fillDatatableTsk)
    {
        $this->fillDatatableTsk = $fillDatatableTsk;
    }
    
    public function run($request)
    {
        $orderData = $this->fillDatatableTsk->byCompanyId($request);

        return $orderData;
    }
}
