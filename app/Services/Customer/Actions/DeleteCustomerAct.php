<?php
/**
 * Created by PhpStorm.
 * User: phuocnt
 * Date: 27/11/2016
 * Time: 13:49
 */

namespace App\Services\Customer\Actions;

use App\Services\Customer\Tasks\DeleteCustomerTsk;

class DeleteCustomerAct
{
    /**
     * @var DeleteCustomerTsk
     */
    private $deleteCustomerTsk;

    public function __construct(DeleteCustomerTsk $deleteCustomerTsk)
    {
        $this->deleteCustomerTsk = $deleteCustomerTsk;
    }

    public function run($customerId)
    {
        $this->deleteCustomerTsk->run($customerId);
    }
}
