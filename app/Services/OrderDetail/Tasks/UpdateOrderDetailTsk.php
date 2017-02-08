<?php

namespace App\Services\OrderDetail\Tasks;

use App\Repositories\OrderDetail\OrderDetailRepo;

class UpdateOrderDetailTsk
{
    /**
     * @var orderDetailRepo
     */
    private $orderDetailRepo;

    public function __construct(OrderDetailRepo $orderDetailRepo)
    {
        $this->orderDetailRepo = $orderDetailRepo;
    }

    public function run($data, $order)
    {
        $existsOrderDetails = $order->orderDetails;

        foreach ($existsOrderDetails as $existsOrderDetail) {
            $dataToUpdate = array_where($data, function ($key, $value) use ($existsOrderDetail) {
                return $value['id'] == $existsOrderDetail->id;
            });
            if ($dataToUpdate) {
                $existsOrderDetail->update(reset($dataToUpdate));
                continue;
            }
            $existsOrderDetail->delete();
        }
        $newOrderDetailData = array_where($data, function ($key, $value) {
            return $value['id'] == false;
        });
        if (empty($newOrderDetailData)) {
            return;
        }
        foreach ($newOrderDetailData as $data) {
            $order->orderDetails()->create($data);
        }
    }
}
