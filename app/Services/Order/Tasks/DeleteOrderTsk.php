<?php
namespace App\Services\Order\Tasks;

use App\Models\CashFlow;
use App\Repositories\CashFlow\CashFlowRepo;
use App\Repositories\Order\OrderRepo;

class DeleteOrderTsk
{
    /**
     * @var OrderRepo
     */
    private $orderRepo;
    /**
     * @var CashFlowRepo
     */
    private $cashFlowRepo;

    public function __construct(OrderRepo $orderRepo, CashFlowRepo $cashFlowRepo)
    {
        $this->orderRepo = $orderRepo;
        $this->cashFlowRepo = $cashFlowRepo;
    }

    public function run($orderId)
    {
        $order = $this->orderRepo->with(['orderDetails', 'orderDetails.item'])->find($orderId);
        foreach ($order->orderDetails as $orderDetail) {
            if ($orderDetail->item->check_in_stock) {
                $orderDetail->item->increment('in_stock', $orderDetail->quantity);
            }
        }
        $order->delete();
        $this->cashFlowRepo->deleteReceipt($orderId, CashFlow::TYPE_ORDER);
    }
}
