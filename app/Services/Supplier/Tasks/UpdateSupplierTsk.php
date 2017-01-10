<?php

namespace App\Services\Supplier\Tasks;

use App\Repositories\Supplier\SupplierRepo;

class UpdateSupplierTsk
{

    /**
     * @var SupplierRepo
     */
    private $supplierRepo;

    public function __construct(SupplierRepo $supplierRepo)
    {
        $this->supplierRepo = $supplierRepo;
    }

    public function run(array $data, $supplierId)
    {
        $formatData = [
            'name' => $data['data'][1],
            'company' => $data['data'][2],
            'email' => $data['data'][3],
            'phone' => $data['data'][4],
            'address' => $data['data'][5]
        ];
        $this->supplierRepo->update($formatData, $supplierId);
    }
}
