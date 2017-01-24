<?php

namespace App\Services\OrderDetail\Tasks;

use App\Repositories\OrderDetail\OrderDetailRepo;

class CreateOrderDetailTsk
{
    /**
     * @var orderDetailRepo
     */
    private $orderDetailRepo;

    public function __construct(OrderDetailRepo $orderDetailRepo)
    {
        $this->orderDetailRepo = $orderDetailRepo;
    }

    public function run($data, $orderId)
    {
        return $this->orderDetailRepo->insertMany($data, true, ['order_id' => $orderId]);
    }
}
