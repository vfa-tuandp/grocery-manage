<?php

namespace App\Services\Order\Actions;

use App\Services\Order\Tasks\DeleteOrderTsk;

class DeleteOrderAct
{
    /**
     * @var DeleteOrderTsk
     */
    private $deleteOrderTsk;

    public function __construct(DeleteOrderTsk $deleteOrderTsk)
    {
        $this->deleteOrderTsk = $deleteOrderTsk;
    }

    public function run($orderId)
    {
        try {
            \DB::beginTransaction();
            $this->deleteOrderTsk->run($orderId);
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollBack();
            throw new \RuntimeException();
        }
    }
}
