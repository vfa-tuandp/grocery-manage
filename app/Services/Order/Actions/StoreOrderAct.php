<?php

namespace App\Services\Order\Actions;

use App\Services\OrderDetail\Tasks\CreateOrderDetailTsk;
use App\Services\Order\Tasks\CreateOrderTsk;

class StoreOrderAct
{

    /**
     * @var CreateOrderTsk
     */
    private $createOrderTsk;
    /**
     * @var CreateOrderDetailTsk
     */
    private $createOrderDetailTsk;

    public function __construct(CreateOrderTsk $createOrderTsk, CreateOrderDetailTsk $createOrderDetailTsk)
    {
        $this->createOrderTsk = $createOrderTsk;
        $this->createOrderDetailTsk = $createOrderDetailTsk;
    }
    
    public function run($data)
    {
        try {
            \DB::beginTransaction();
            $newOrder = $this->createOrderTsk->run($data);
            $this->createOrderDetailTsk->run($data['items'], $newOrder->id);
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollBack();
            throw new \RuntimeException('co loi');
        }
    }
}
