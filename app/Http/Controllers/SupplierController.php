<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Services\Supplier\Actions\DeleteSupplierAct;
use App\Services\Supplier\Actions\FillDatatableByCompanyAct;
use App\Services\Supplier\Actions\NewSupplierAct;
use App\Services\Supplier\Actions\UpdateSupplierAct;
use Illuminate\Http\Request;

use App\Http\Requests;

class SupplierController extends Controller
{
    public function index()
    {
        return view('suppliers.index');
    }

    public function fillDatatable(FillDatatableByCompanyAct $datatable)
    {
        return $datatable->run();
    }

    public function destroy($id, DeleteSupplierAct $deleteSupplierAct)
    {
        $deleteSupplierAct->run($id);
    }

    public function store(StoreSupplierRequest $request, NewSupplierAct $newSupplier)
    {
        if ($request->ajax()) {
            $supplierId = $newSupplier->run($request->get('data'));
            return $supplierId;
        }
    }

    public function update(UpdateSupplierRequest $request, $id, UpdateSupplierAct $updateSupplierAct)
    {
        if ($request->ajax()) {
            $updateSupplierAct->run($request->all(), $id);
        }
    }
}
