<?php

namespace App\Repositories\OrderDetail;

use App\Models\OrderDetail;
use App\Repositories\MyBaseRepository;

/**
 * Class OrderDetailRepositoryEloquent
 * @package namespace App\Repositories;
 */
class OrderDetailRepoEloquent extends MyBaseRepository implements OrderDetailRepo
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return OrderDetail::class;
    }
}
