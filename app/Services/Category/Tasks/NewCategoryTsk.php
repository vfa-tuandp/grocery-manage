<?php

namespace App\Services\Category\Tasks;

use App\Repositories\Category\CategoryRepo;

class NewCategoryTsk
{
    /**
     * @var CategoryRepo
     */
    private $categoryRepo;

    public function __construct (CategoryRepo $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }
    
    public function run(array $data)
    {
        return $this->categoryRepo->create($data);
    }
}