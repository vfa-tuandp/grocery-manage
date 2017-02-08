<?php

namespace App\Services\Order\Tasks;

use App\Repositories\Order\OrderRepo;

class GetOrderTsk
{
    /**
     * @var OrderRepo
     */
    private $orderRepo;

    public function __construct(OrderRepo $orderRepo)
    {
        $this->orderRepo = $orderRepo;
    }

    public function byId($orderId, $relations = [])
    {
        if (!empty($relations)) {
            return $this->orderRepo->with($relations)->find($orderId);
        }
        return $this->orderRepo->find($orderId);
    }
}
