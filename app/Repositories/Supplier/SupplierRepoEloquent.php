<?php

namespace App\Repositories\Supplier;

use App\Models\Supplier;
use App\Repositories\MyBaseRepository;

/**
 * Class CategoryRepositoryEloquent
 * @package namespace App\Repositories;
 */
class SupplierRepoEloquent extends MyBaseRepository implements SupplierRepo
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Supplier::class;
    }
}
