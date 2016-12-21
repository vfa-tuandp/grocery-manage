<?php

namespace App\Services\Item\Actions;

use App\Services\Category\Tasks\ListCategoryTsk;

class CreateItemAct
{
    /**
     * @var ListCategoryTsk
     */
    private $listCategoryTsk;

    public function __construct(ListCategoryTsk $listCategoryTsk)
    {
        $this->listCategoryTsk = $listCategoryTsk;
    }

    public function run()
    {
        return $this->listCategoryTsk->byCompanyId();
    }
}
