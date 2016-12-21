<?php

namespace App\Repositories\Item;

use App\Models\Item;
use App\Repositories\MyBaseRepository;

/**
 * Class ItemRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ItemRepoEloquent extends MyBaseRepository implements ItemRepo
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Item::class;
    }
}
