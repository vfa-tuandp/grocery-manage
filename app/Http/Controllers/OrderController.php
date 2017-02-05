<?php

namespace App\Http\Controllers;

//use App\Http\Requests\StoreOrderRequest;
//use App\Http\Requests\UpdateOrderRequest;
//use App\Services\Order\Actions\CreateOrderAct;
//use App\Services\Order\Actions\DeleteOrderAct;
//use App\Services\Order\Actions\EditOrderAct;
use App\Services\Order\Actions\FillDatatableByCompanyAct;
//use App\Services\Order\Actions\StoreOrderAct;
//use App\Services\Order\Actions\UpdateOrderAct;

use App\Http\Requests;
use App\Http\Requests\StoreOrderRequest;
use App\Services\Order\Actions\CreateOrderAct;
use App\Services\Order\Actions\GetOrderDetailByOrderIdAct;
use App\Services\Order\Actions\StoreOrderAct;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('orders.index');
    }

    public function fillDatatable(FillDatatableByCompanyAct $datatable, Request $request)
    {
        return $datatable->run($request->all());
    }

//    public function edit($id, EditOrderAct $editOrderAct)
//    {
//        list($order, $categories) = $editOrderAct->run($id);
//        return view('orders.edit', ['order' => $order, 'categories' => $categories]);
//    }
//
//    public function update(UpdateOrderRequest $request, $id, UpdateOrderAct $updateOrderAct)
//    {
//        $updateOrderAct->run($id, $request->all());
//        return redirect()->back()->with('success', 'Cập nhật thành công!!');
//    }
//
//    public function destroy($id, DeleteOrderAct $deleteOrderAct)
//    {
//        $deleteOrderAct->run($id);
//    }

    public function create(CreateOrderAct $createOrderAct)
    {
        list($categories, $customers) = $createOrderAct->run();

        return view('orders.create', compact('categories', 'customers'));
    }

    public function store(StoreOrderRequest $request, StoreOrderAct $storeOrderAct)
    {
        if ($request->ajax()) {
            $storeOrderAct->run($request->all());
        }
    }

    public function getOrderDetail($id, GetOrderDetailByOrderIdAct $getOrderDetailByOrderIdAct)
    {
        if (request()->ajax()) {
            return $getOrderDetailByOrderIdAct->run($id);
        }
    }
}
