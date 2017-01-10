<?php

namespace App\Services\Supplier\Tasks;

use App\Repositories\Supplier\SupplierRepo;

class DeleteSupplierTsk
{
    /**
     * @var SupplierRepo
     */
    private $supplierRepo;

    public function __construct(SupplierRepo $supplierRepo)
    {
        $this->supplierRepo = $supplierRepo;
    }

    public function run($supplierId)
    {
        $this->supplierRepo->delete($supplierId);
    }
}
