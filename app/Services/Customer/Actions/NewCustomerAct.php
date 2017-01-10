<?php

namespace App\Services\Customer\Actions;

use App\Services\Customer\Tasks\NewCustomerTsk;

class NewCustomerAct
{
    /**
     * @var NewCustomerTsk
     */
    private $newCustomerTsk;

    public function __construct(NewCustomerTsk $newCustomerTsk)
    {
        $this->newCustomerTsk = $newCustomerTsk;
    }
    
    public function run(array $data)
    {
        try {
            $newCustomer = $this->newCustomerTsk->run($data);
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
        }

        return $newCustomer->id;
    }
}
