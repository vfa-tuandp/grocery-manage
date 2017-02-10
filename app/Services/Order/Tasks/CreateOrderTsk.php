<?php

namespace App\Services\Order\Tasks;

use App\Models\CashFlow;
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

        $newOrder = $this->orderRepo->create($data);

        $cashFlowData = [
            'datetime' => $data['datetime'],
            'type' => CashFlow::THU,
            'content' => 'Bán hàng #' . $newOrder->id,
            'value' => $data['total'],
            'company_id' => $data['company_id']
        ];
        $newOrder->cashFlow()->create($cashFlowData);

        return $newOrder;
    }
}
