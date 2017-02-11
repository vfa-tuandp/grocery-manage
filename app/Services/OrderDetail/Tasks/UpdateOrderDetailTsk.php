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
                $dataToUpdate = reset($dataToUpdate);
                if ($existsOrderDetail->item->check_in_stock) {
                    $existsOrderDetail->item->in_stock = $existsOrderDetail->item->in_stock
                        + $existsOrderDetail->quantity
                        - $dataToUpdate['quantity'];

                    $existsOrderDetail->item->save();
                }
                $existsOrderDetail->update($dataToUpdate);
                continue;
            }

            if ($existsOrderDetail->item->check_in_stock) {
                $existsOrderDetail->item->increment('in_stock', $existsOrderDetail->quantity);
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
            $orderDetail = $order->orderDetails()->create($data);
            if ($orderDetail->item->check_in_stock) {
                $orderDetail->item->decrement('in_stock', $data['quantity']);
            };
        }
    }
}
