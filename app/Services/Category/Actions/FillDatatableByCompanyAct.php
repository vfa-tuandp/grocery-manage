<?php

namespace App\Services\Category\Actions;

use App\Services\Category\Tasks\FillDatatableTsk;

class FillDatatableByCompanyAct
{

    private $fillDatatableTsk;

    public function __construct (FillDatatableTsk $fillDatatableTsk)
    {
        $this->fillDatatableTsk = $fillDatatableTsk;
    }
    
    public function run()
    {
        $categoryData = $this->fillDatatableTsk->byCompanyId();

        return $categoryData;
    }
}