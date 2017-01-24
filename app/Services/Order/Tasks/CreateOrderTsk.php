<?php

namespace App\Services\Order\Tasks;

use App\Repositories\Order\OrderRepo;

class CreateOrderTsk
{
    /**
     * @var OrderRepo
     */
    private $orderRepo;

    public function __construct(OrderRepo $orderRepo)
    {
        $this->orderRepo = $orderRepo;
    }

    public function run($data)
    {
        $data['datetime'] = parseFromDateTimePicker($data['datetime']);
        $data['company_id'] = auth()->user()->company_id;

        return $this->orderRepo->create($data);
    }
}
