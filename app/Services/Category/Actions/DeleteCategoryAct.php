<?php
/**
 * Created by PhpStorm.
 * User: phuocnt
 * Date: 27/11/2016
 * Time: 13:49
 */

namespace App\Services\Category\Actions;


use App\Services\Category\Tasks\DeleteCategoryTsk;

class DeleteCategoryAct
{
    /**
     * @var DeleteCategoryTsk
     */
    private $deleteCategoryTsk;

    public function __construct(DeleteCategoryTsk $deleteCategoryTsk)
    {
        $this->deleteCategoryTsk = $deleteCategoryTsk;
    }

    public function run($categoryId)
    {
        $this->deleteCategoryTsk->run($categoryId);
    }
}