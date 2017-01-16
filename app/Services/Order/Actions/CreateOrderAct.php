<?php

namespace App\Services\Order\Actions;

use App\Services\Category\Tasks\ListCategoryTsk;
use App\Services\Customer\Tasks\ListCustomerTsk;

class CreateOrderAct
{
    /**
     * @var ListCategoryTsk
     */
    private $listCategoryTsk;
    /**
     * @var ListCustomerTsk
     */
    private $listCustomerTsk;

    public function __construct(ListCategoryTsk $listCategoryTsk, ListCustomerTsk $listCustomerTsk)
    {
        $this->listCategoryTsk = $listCategoryTsk;
        $this->listCustomerTsk = $listCustomerTsk;
    }

    public function run()
    {
        $listCategory = $this->listCategoryTsk->byCompanyId();
        $listCustomer = $this->listCustomerTsk->byCompanyId();

        return [$listCategory, $listCustomer];
    }
}
