<?php

namespace App\Services\Item\Actions;

use App\Services\Category\Tasks\CustomizeItemDataTsk;
use App\Services\Item\Tasks\StoreItemTsk;

class StoreItemAct
{
    /**
     * @var StoreItemTsk
     */
    private $storeItemTsk;
    /**
     * @var CustomizeItemDataTsk
     */
    private $customizeItemDataTsk;

    public function __construct(StoreItemTsk $storeItemTsk, CustomizeItemDataTsk $customizeItemDataTsk)
    {
        $this->storeItemTsk = $storeItemTsk;
        $this->customizeItemDataTsk = $customizeItemDataTsk;
    }

    public function run($data)
    {
        $data = $this->customizeItemDataTsk->reformatCheckInStockAttribute($data);
        $data = $this->customizeItemDataTsk->verifyInStockAttribute($data);
        $this->storeItemTsk->run($data);
    }
}
