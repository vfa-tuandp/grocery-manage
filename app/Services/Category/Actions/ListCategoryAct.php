<?php

namespace App\Services\Category\Actions;

use App\Services\Category\Tasks\ListCategoryTsk;

class ListCategoryAct
{
    /**
     * @var ListCategoryTsk
     */
    private $listCategoryTask;

    /**
     * ListCategoryAction constructor.
     *
     * @param ListCategoryTsk $listCategoryTask
     */
    public function __construct(ListCategoryTsk $listCategoryTask)
    {
        $this->listCategoryTask = $listCategoryTask;
    }

    public function run()
    {
        $categories = $this->listCategoryTask->byCompanyId();

        return $categories;
    }
}
