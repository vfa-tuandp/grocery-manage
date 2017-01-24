<?php
namespace App\Services\Item\Tasks;

use App\Repositories\Item\ItemRepo;

class UpdateItemTsk
{
    /**
     * @var ItemRepo
     */
    private $itemRepo;

    public function __construct(ItemRepo $itemRepo)
    {
        $this->itemRepo = $itemRepo;
    }

    public function run($itemId, $data)
    {
        $this->itemRepo->update($data, $itemId);
    }
}
