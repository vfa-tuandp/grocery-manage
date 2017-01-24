<?php

namespace App\Services\Customer\Tasks;

use App\Repositories\Customer\CustomerRepo;

class ListCustomerTsk
{
    /**
     * @var CustomerRepo
     */
    private $customerRepo;

    public function __construct(CustomerRepo $customerRepo)
    {
        $this->customerRepo = $customerRepo;
    }

    public function byCompanyId($companyId = null)
    {
        $companyId ? : $companyId = auth()->user()->company_id;
        return $this->customerRepo->findByField('company_id', $companyId);
    }
}
