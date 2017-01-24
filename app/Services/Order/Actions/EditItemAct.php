<?php

namespace App\Services\Item\Actions;

use App\Services\Category\Tasks\ListCategoryTsk;
use App\Services\Item\Tasks\GetItemsTsk;

class EditItemAct
{
    private $getItemTsk;
    /**
     * @var ListCategoryTsk
     */
    private $listCategoryTsk;

    public function __construct(GetItemsTsk $getItemTsk, ListCategoryTsk $listCategoryTsk)
    {
        $this->getItemTsk = $getItemTsk;
        $this->listCategoryTsk = $listCategoryTsk;
    }

    public function run($itemId)
    {
        $item = $this->getItemTsk->getOneById($itemId);
        $categories = $this->listCategoryTsk->byCompanyId($item->company_id);
        return [$item, $categories];
    }
}
