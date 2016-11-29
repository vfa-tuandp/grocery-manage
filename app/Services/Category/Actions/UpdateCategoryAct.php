<?php

namespace App\Services\Category\Actions;

use App\Services\Category\Tasks\UpdateCategoryTsk;

class UpdateCategoryAct
{
    /**
     * @var UpdateCategoryTsk
     */
    private $updateCategoryTsk;

    public function __construct (UpdateCategoryTsk $updateCategoryTsk)
    {
        $this->updateCategoryTsk = $updateCategoryTsk;
    }

    public function run($data, $categoryId)
    {
        $this->updateCategoryTsk->run($data, $categoryId);
    }
}