<?php

namespace App\Services\Item\Actions;

use App\Services\Item\Tasks\DeleteItemTsk;

class DeleteItemAct
{
    /**
     * @var DeleteItemTsk
     */
    private $deleteItemTsk;

    public function __construct(DeleteItemTsk $deleteItemTsk)
    {
        $this->deleteItemTsk = $deleteItemTsk;
    }

    public function run($itemId)
    {
        $this->deleteItemTsk->run($itemId);
    }
}
