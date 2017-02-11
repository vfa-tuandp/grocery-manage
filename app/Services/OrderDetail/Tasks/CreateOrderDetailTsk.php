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
        foreach ($data as $value) {
            $orderDetail = $this->orderDetailRepo->create(array_merge($value, ['order_id' => $orderId]));
            if ($orderDetail->item->check_in_stock) {
                $orderDetail->item->decrement('in_stock', $value['quantity']);
            };
        }
    }
}
