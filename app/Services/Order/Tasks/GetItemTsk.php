<?php

namespace App\Services\Item\Tasks;

use App\Repositories\Item\ItemRepo;

class GetItemTsk
{
    /**
     * @var ItemRepo
     */
    private $itemRepo;

    public function __construct(ItemRepo $itemRepo)
    {
        $this->itemRepo = $itemRepo;
    }

    public function byId($itemId)
    {
        return $this->itemRepo->find($itemId);
    }
}
