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

        return $this->orderRepo->update($data, $id);
    }
}
