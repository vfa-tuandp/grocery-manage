<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\StoreCashFlowRequest;
use App\Http\Requests\UpdateCashFlowRequest;
use App\Services\CashFlow\Actions\DeleteCashFlowAct;
use App\Services\CashFlow\Actions\EditCashFlowAct;
use App\Services\CashFlow\Actions\FillCashFlowAct;
use App\Services\CashFlow\Actions\StoreCashFlowAct;
use App\Services\CashFlow\Actions\UpdateCashFlowAct;
use Illuminate\Http\Request;

class CashFlowController extends Controller
{
    public function index()
    {
        return view('cash_flows.index');
    }

    public function fillCashFlow(Request $request, FillCashFlowAct $fillCashFlowAct)
    {
        return $fillCashFlowAct->run($request->all());
    }

    public function edit($id, EditCashFlowAct $editCashFlowAct)
    {
        $cashFlow = $editCashFlowAct->run($id);
        return view('cash_flows.edit', compact('cashFlow'));
    }

    public function update(UpdateCashFlowRequest $request, $id, UpdateCashFlowAct $updateCashFlowAct)
    {
        $updateCashFlowAct->run($id, $request->all());
        return redirect()->route('cash_flow.index')->with('success', 'Cập nhật thành công!!');
    }

    public function destroy($id, DeleteCashFlowAct $deleteCashFlowAct)
    {
        $deleteCashFlowAct->run($id);
    }

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
