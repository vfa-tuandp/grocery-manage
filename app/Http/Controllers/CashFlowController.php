<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\StoreCashFlowRequest;
use App\Services\CashFlow\Actions\StoreCashFlowAct;
use Illuminate\Http\Request;

class CashFlowController extends Controller
{
//    public function index()
//    {
//        return view('items.index');
//    }
//
//    public function fillDatatable(FillDatatableByCompanyAct $datatable)
//    {
//        return $datatable->run();
//    }
//
//    public function edit($id, EditItemAct $editItemAct)
//    {
//        list($item, $categories) = $editItemAct->run($id);
//        return view('items.edit', ['item' => $item, 'categories' => $categories]);
//    }
//
//    public function update(UpdateItemRequest $request, $id, UpdateItemAct $updateItemAct)
//    {
//        $updateItemAct->run($id, $request->all());
//        return redirect()->back()->with('success', 'Cập nhật thành công!!');
//    }
//
//    public function destroy($id, DeleteItemAct $deleteItemAct)
//    {
//        $deleteItemAct->run($id);
//    }

    public function create()
    {
        return view('cash_flows.create');
    }

    public function store(StoreCashFlowRequest $request, StoreCashFlowAct $storeCashFLowAct)
    {
        $storeCashFLowAct->run($request->all());

        return redirect()->route('cash_flow.create')->with('success', 'Thêm thành công!!');
    }
//
//    public function getItemByCategoryId($categoryId, GetItemsByCategoryIdAct $listItemAct)
//    {
//        if (request()->ajax()) {
//            $items = $listItemAct->run($categoryId);
//            return $items;
//        }
//    }
//
//    public function stock()
//    {
//        return view('items.stock');
//    }
//
//    public function getStock(Request $request, GetStockAct $getStockAct)
//    {
//        return $getStockAct->run($request->all());
//    }
}
