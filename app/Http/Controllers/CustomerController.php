<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Services\Customer\Actions\DeleteCustomerAct;
use App\Services\Customer\Actions\FillDatatableByCompanyAct;
use App\Services\Customer\Actions\NewCustomerAct;
use App\Services\Customer\Actions\UpdateCustomerAct;
use Illuminate\Http\Request;

use App\Http\Requests;

class CustomerController extends Controller
{
    public function index()
    {
        return view('customers.index');
    }

    public function fillDatatable(FillDatatableByCompanyAct $datatable)
    {
        return $datatable->run();
    }

    public function destroy($id, DeleteCustomerAct $deleteCustomerAct)
    {
        $deleteCustomerAct->run($id);
    }
//
//    public function store(StoreCustomerRequest $request, NewCustomerAct $newCustomer)
//    {
//        if ($request->ajax()) {
//            $customerId = $newCustomer->run(['name' => $request->get('data')[1]]);
//            return $customerId;
//        }
//    }

    public function update(UpdateCustomerRequest $request, $id, UpdateCustomerAct $updateCustomerAct)
    {
        if ($request->ajax()) {
            $updateCustomerAct->run($request->all(), $id);
        }
    }
}
