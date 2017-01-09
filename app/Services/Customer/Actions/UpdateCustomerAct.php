<?php

namespace App\Services\Customer\Actions;

use App\Services\Customer\Tasks\UpdateCustomerTsk;

class UpdateCustomerAct
{
    /**
     * @var UpdateCustomerTsk
     */
    private $updateCustomerTsk;

    public function __construct(UpdateCustomerTsk $updateCustomerTsk)
    {
        $this->updateCustomerTsk = $updateCustomerTsk;
    }

    public function run($data, $customerId)
    {
        $this->updateCustomerTsk->run($data, $customerId);
    }
}
