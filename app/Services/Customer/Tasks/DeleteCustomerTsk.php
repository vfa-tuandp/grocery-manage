<?php

namespace App\Services\Customer\Tasks;

use App\Repositories\Customer\CustomerRepo;

class DeleteCustomerTsk
{
    /**
     * @var CustomerRepo
     */
    private $customerRepo;

    public function __construct(CustomerRepo $customerRepo)
    {
        $this->customerRepo = $customerRepo;
    }

    public function run($customerId)
    {
        $this->customerRepo->delete($customerId);
    }
}
