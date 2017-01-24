<?php

namespace App\Repositories\Order;

use App\Models\Order;
use App\Repositories\MyBaseRepository;

/**
 * Class OrderRepositoryEloquent
 * @package namespace App\Repositories;
 */
class OrderRepoEloquent extends MyBaseRepository implements OrderRepo
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Order::class;
    }
}
