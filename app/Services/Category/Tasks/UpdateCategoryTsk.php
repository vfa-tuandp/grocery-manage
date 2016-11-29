<?php

namespace App\Services\Category\Tasks;

use App\Repositories\Category\CategoryRepo;

class UpdateCategoryTsk
{

    /**
     * @var CategoryRepo
     */
    private $categoryRepo;

    public function __construct(CategoryRepo $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function run(array $data, $categoryId)
    {
        $this->categoryRepo->update($data, $categoryId);
    }
}
