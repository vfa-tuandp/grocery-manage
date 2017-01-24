<?php

namespace App\Services\Item\Actions;

use App\Services\Item\Tasks\GetItemsTsk;

class GetItemsByCategoryIdAct
{
    /**
     * @var GetItemsTsk
     */
    private $getItemsTsk;

    public function __construct(GetItemsTsk $getItemsTsk)
    {
        $this->getItemsTsk = $getItemsTsk;
    }
    
    public function run($categoryId)
    {
        $items = $this->getItemsTsk->byCategoryId($categoryId);

        return $items;
    }
}
