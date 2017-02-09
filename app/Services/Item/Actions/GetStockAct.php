<?php

namespace App\Services\Item\Actions;

use App\Services\Item\Tasks\GetStockTsk;

class GetStockAct
{
    /**
     * @var GetStockTsk
     */
    private $getStockTsk;

    public function __construct(GetStockTsk $getStockTsk)
    {
        $this->getStockTsk = $getStockTsk;
    }
    
    public function run($request)
    {
        return $this->getStockTsk->run($request);
    }
}
