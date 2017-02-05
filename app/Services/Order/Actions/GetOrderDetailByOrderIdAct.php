<?php

namespace App\Services\Order\Actions;

use App\Services\Order\Tasks\GetOrderDetailTsk;

class GetOrderDetailByOrderIdAct
{
    /**
     * @var GetOrderDetailTsk
     */
    private $getOrderDetailTsk;

    public function __construct (GetOrderDetailTsk $getOrderDetailTsk)
    {
        $this->getOrderDetailTsk = $getOrderDetailTsk;
    }
    
    public function run($orderId)
    {
        return $this->getOrderDetailTsk->byOrderId($orderId, 'item');
    }
}
