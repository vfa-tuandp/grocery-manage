<?php

namespace App\Services\Customer\Tasks;

use App\Repositories\Customer\CustomerRepo;

class UpdateCustomerTsk
{

    /**
     * @var CustomerRepo
     */
    private $customerRepo;

    public function __construct(CustomerRepo $customerRepo)
    {
        $this->customerRepo = $customerRepo;
    }

    public function run(array $data, $customerId)
    {
        $formatData = [
            'name' => $data['data'][1],
            'company' => $data['data'][2],
            'email' => $data['data'][3],
            'phone' => $data['data'][4],
            'address' => $data['data'][5]
        ];
        $this->customerRepo->update($formatData, $customerId);
    }
}
