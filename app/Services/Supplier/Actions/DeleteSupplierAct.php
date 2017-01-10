<?php
/**
 * Created by PhpStorm.
 * User: phuocnt
 * Date: 27/11/2016
 * Time: 13:49
 */

namespace App\Services\Supplier\Actions;

use App\Services\Supplier\Tasks\DeleteSupplierTsk;

class DeleteSupplierAct
{
    /**
     * @var DeleteSupplierTsk
     */
    private $deleteSupplierTsk;

    public function __construct(DeleteSupplierTsk $deleteSupplierTsk)
    {
        $this->deleteSupplierTsk = $deleteSupplierTsk;
    }

    public function run($supplierId)
    {
        $this->deleteSupplierTsk->run($supplierId);
    }
}
