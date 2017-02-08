<?php

namespace App\Services\Order\Actions;

use App;
use App\Services\Category\Tasks\ListCategoryTsk;
use App\Services\Customer\Tasks\ListCustomerTsk;
use App\Services\Order\Tasks\GetOrderTsk;

class EditOrderAct
{
    /**
     * @var ListCategoryTsk
     */
    private $listCategoryTsk;
    /**
     * @var ListCustomerTsk
     */
    private $listCustomerTsk;
    /**
     * @var GetOrderTsk
     */
    private $getOrderTsk;

    public function __construct(ListCategoryTsk $listCategoryTsk, ListCustomerTsk $listCustomerTsk, GetOrderTsk $getOrderTsk)
    {
        $this->listCategoryTsk = $listCategoryTsk;
        $this->listCustomerTsk = $listCustomerTsk;
        $this->getOrderTsk = $getOrderTsk;
    }

    public function run($orderId)
    {
        $listCategory = $this->listCategoryTsk->byCompanyId();
        $listCustomer = $this->listCustomerTsk->byCompanyId();
        
        $currentOrder = $this->getOrderTsk->byId($orderId, ['orderDetails', 'orderDetails.item.category']);

        if ($currentOrder->company_id != auth()->user()->company_id) {
            App::abort(404);
        }
        
        return [$listCategory, $listCustomer, $currentOrder];
    }
}
