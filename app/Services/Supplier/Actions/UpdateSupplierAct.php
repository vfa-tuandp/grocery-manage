<?php

namespace App\Services\Supplier\Actions;

use App\Services\Supplier\Tasks\UpdateSupplierTsk;

class UpdateSupplierAct
{
    /**
     * @var UpdateSupplierTsk
     */
    private $updateSupplierTsk;

    public function __construct(UpdateSupplierTsk $updateSupplierTsk)
    {
        $this->updateSupplierTsk = $updateSupplierTsk;
    }

    public function run($data, $supplierId)
    {
        $this->updateSupplierTsk->run($data, $supplierId);
    }
}
