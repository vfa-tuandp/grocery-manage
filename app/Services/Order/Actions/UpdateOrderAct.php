<?php

namespace App\Services\Order\Actions;

use App\Services\Order\Tasks\UpdateOrderTsk;
use App\Services\OrderDetail\Tasks\UpdateOrderDetailTsk;

class UpdateOrderAct
{

    /**
     * @var UpdateOrderTsk
     */
    private $updateOrderTsk;
    /**
     * @var UpdateOrderDetailTsk
     */
    private $updateOrderDetailTsk;

    public function __construct(UpdateOrderTsk $updateOrderTsk, UpdateOrderDetailTsk $updateOrderDetailTsk)
    {
        $this->updateOrderTsk = $updateOrderTsk;
        $this->updateOrderDetailTsk = $updateOrderDetailTsk;
    }
    
    public function run($data, $orderId)
    {
        try {
            \DB::beginTransaction();
            $updatedOrder = $this->updateOrderTsk->run($data, $orderId);
            $this->updateOrderDetailTsk->run($data['items'], $updatedOrder);
            \DB::commit();
            return true;
        } catch (\Exception $e) {
            \DB::rollBack();
            return false;
        }
    }
}
