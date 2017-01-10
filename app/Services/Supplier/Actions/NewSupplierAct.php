<?php

namespace App\Services\Supplier\Actions;

use App\Services\Supplier\Tasks\NewSupplierTsk;

class NewSupplierAct
{
    /**
     * @var NewSupplierTsk
     */
    private $newSupplierTsk;

    public function __construct(NewSupplierTsk $newSupplierTsk)
    {
        $this->newSupplierTsk = $newSupplierTsk;
    }
    
    public function run(array $data)
    {
        try {
            $newSupplier = $this->newSupplierTsk->run($data);
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
        }

        return $newSupplier->id;
    }
}
