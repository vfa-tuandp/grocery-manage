<?php

namespace App\Services\Order\Tasks;

use App\Repositories\Order\OrderRepo;

class UpdateOrderTsk
{
    /**
     * @var OrderRepo
     */
    private $orderRepo;

    public function __construct(OrderRepo $orderRepo)
    {
        $this->orderRepo = $orderRepo;
    }

    public function run($data, $id)
    {
        $data['datetime'] = parseFromDateTimePicker($data['datetime']);

        $updatedOrder = $this->orderRepo->update($data, $id);

        $cashFlow = $updatedOrder->cashFlow;
        $cashFlow->datetime = $data['datetime'];
        $cashFlow->value = $data['total'];
        $cashFlow->save();
        
        return $updatedOrder;
    }
}
