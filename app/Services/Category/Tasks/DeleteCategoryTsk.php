<?php

namespace App\Services\Category\Tasks;

use App\Repositories\Category\CategoryRepo;

class DeleteCategoryTsk
{
    /**
     * @var CategoryRepo
     */
    private $categoryRepo;

    public function __construct(CategoryRepo $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function run($categoryId)
    {
        $this->categoryRepo->delete($categoryId);
    }
}