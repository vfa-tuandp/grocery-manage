<?php

namespace App\Services\Supplier\Tasks;

use App\Repositories\Supplier\SupplierRepo;

class NewSupplierTsk
{
    /**
     * @var SupplierRepo
     */
    private $supplierRepo;

    public function __construct(SupplierRepo $supplierRepo)
    {
        $this->supplierRepo = $supplierRepo;
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
        return $this->supplierRepo->create($formatData);
    }
}
