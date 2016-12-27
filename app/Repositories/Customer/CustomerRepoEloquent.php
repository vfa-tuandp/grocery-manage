<?php

namespace App\Repositories\Customer;

use App\Models\Customer;
use App\Repositories\MyBaseRepository;

/**
 * Class CategoryRepositoryEloquent
 * @package namespace App\Repositories;
 */
class CustomerRepoEloquent extends MyBaseRepository implements CustomerRepo
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Customer::class;
    }
}
