<?php

namespace App\Services\Order\Tasks;

use App\Repositories\OrderDetail\OrderDetailRepo;

class GetOrderDetailTsk
{
    /**
     * @var OrderDetailRepo
     */
    private $orderDetailRepo;

    public function __construct(OrderDetailRepo $orderDetailRepo)
    {
        $this->orderDetailRepo = $orderDetailRepo;
    }

    public function byOrderId($orderId, $relations = [])
    {
        if (!empty($relations)) {
            return $this->orderDetailRepo->with($relations)->findByField('order_id', $orderId);
        }
        return $this->orderDetailRepo->findByField('order_id', $orderId);
    }
}
