<?php

namespace App\Services\Supplier\Tasks;

use App\Repositories\Supplier\SupplierRepo;

class ListSupplierTsk
{
    /**
     * @var SupplierRepo
     */
    private $supplierRepo;

    public function __construct(SupplierRepo $supplierRepo)
    {
        $this->supplierRepo = $supplierRepo;
    }

    public function byCompanyId($companyId = null)
    {
        $companyId ? : $companyId = auth()->user()->company_id;
        return $this->supplierRepo->findByField('company_id', $companyId);
    }
}
