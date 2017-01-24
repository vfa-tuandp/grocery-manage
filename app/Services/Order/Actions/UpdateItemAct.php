<?php

namespace App\Services\Item\Actions;

use App\Services\Category\Tasks\CustomizeItemDataTsk;
use App\Services\Item\Tasks\UpdateItemTsk;

class UpdateItemAct
{
    private $updateItemTsk;
    private $customizeItemDataTsk;

    public function __construct(UpdateItemTsk $updateItemTsk, CustomizeItemDataTsk $customizeItemDataTsk)
    {
        $this->updateItemTsk = $updateItemTsk;
        $this->customizeItemDataTsk = $customizeItemDataTsk;
    }


    public function run($itemId, $data)
    {
        $data = $this->customizeItemDataTsk->reformatCheckInStockAttribute($data);
        $data = $this->customizeItemDataTsk->verifyInStockAttribute($data);
        $this->updateItemTsk->run($itemId, $data);
    }
}
