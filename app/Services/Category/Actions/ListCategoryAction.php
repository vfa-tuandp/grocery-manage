<?php

namespace App\Services\Category\Actions;

use App\Services\Category\Tasks\ListCategoryTask;

class ListCategoryAction
{
    /**
     * @var ListCategoryTask
     */
    private $listCategoryTask;

    /**
     * ListCategoryAction constructor.
     *
     * @param ListCategoryTask $listCategoryTask
     */
    public function __construct (ListCategoryTask $listCategoryTask)
    {
        $this->listCategoryTask = $listCategoryTask;
    }

    public function run()
    {
        $categories = $this->listCategoryTask->byCompanyId();

        return $categories;
    }
}