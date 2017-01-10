<?php

namespace App\Services\Customer\Tasks;

use App\Repositories\Customer\CustomerRepo;

class NewCustomerTsk
{
    /**
     * @var CustomerRepo
     */
    private $customerRepo;

    public function __construct(CustomerRepo $customerRepo)
    {
        $this->customerRepo = $customerRepo;
    }
    
    public function run(array $data)
    {
        $formatData = [
            'name' => $data[1],
            'company' => $data[2],
            'email' => $data[3],
            'phone' => $data[4],
            'address' => $data[5],
            'company_id' => auth()->user()->company_id
        ];
        return $this->customerRepo->create($formatData);
    }
}
