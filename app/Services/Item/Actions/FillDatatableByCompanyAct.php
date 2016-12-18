<?php

namespace App\Services\Item\Actions;

use App\Services\Item\Tasks\FillDatatableTsk;

class FillDatatableByCompanyAct
{

    private $fillDatatableTsk;

    public function __construct(FillDatatableTsk $fillDatatableTsk)
    {
        $this->fillDatatableTsk = $fillDatatableTsk;
    }
    
    public function run()
    {
        $itemData = $this->fillDatatableTsk->byCompanyId();

        return $itemData;
    }
}
