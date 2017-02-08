<?php
namespace App\Services\Order\Tasks;

use App\Repositories\Order\OrderRepo;

class DeleteOrderTsk
{
    /**
     * @var OrderRepo
     */
    private $orderRepo;

    public function __construct(OrderRepo $orderRepo)
    {
        $this->orderRepo = $orderRepo;
    }

    public function run($orderId)
    {
        $this->orderRepo->delete($orderId);
    }
}
