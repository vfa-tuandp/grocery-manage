<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\MyBaseRepository;

/**
 * Class CategoryRepositoryEloquent
 * @package namespace App\Repositories;
 */
class CategoryRepoEloquent extends MyBaseRepository implements CategoryRepo
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Category::class;
    }
}
