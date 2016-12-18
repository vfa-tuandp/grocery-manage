<?php

namespace App\Http\Controllers;

//use App\Http\Requests\StoreItemRequest;
//use App\Http\Requests\UpdateItemRequest;
//use App\Services\Item\Actions\DeleteItemAct;
use App\Services\Item\Actions\FillDatatableByCompanyAct;
//use App\Services\Item\Actions\NewItemAct;
//use App\Services\Item\Actions\UpdateItemAct;
use Illuminate\Http\Request;

use App\Http\Requests;

class ItemController extends Controller
{
    public function index()
    {
        return view('items.index');
    }

    public function fillDatatable(FillDatatableByCompanyAct $datatable)
    {
        return $datatable->run();
    }

    public function edit($id)
    {
        dd(123);
    }
//
//    public function destroy($id, DeleteItemAct $deleteItemAct)
    public function destroy($id)
    {
//        $deleteItemAct->run($id);
        dd(456);
    }
//
//    public function store(StoreItemRequest $request, NewItemAct $newItem)
//    {
//        if ($request->ajax()) {
//            $itemId = $newItem->run(['name' => $request->get('data')[1]]);
//            return $itemId;
//        }
//    }
//
//    public function update(UpdateItemRequest $request, $id, UpdateItemAct $updateItemAct)
//    {
//        if ($request->ajax()) {
//            $updateItemAct->run(['name' => $request->get('data')[1]], $id);
//        }
//    }
}
