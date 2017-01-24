<?php
namespace App\Services\Item\Tasks;

use App\Repositories\Item\ItemRepo;

class StoreItemTsk
{
    /**
     * @var ItemRepo
     */
    private $itemRepo;

    public function __construct(ItemRepo $itemRepo)
    {
        $this->itemRepo = $itemRepo;
    }

    public function run($data)
    {
        if (empty($data['company_id'])) {
            $data['company_id'] = auth()->user()->company_id;
        }

        return $this->itemRepo->create($data);
    }
}
