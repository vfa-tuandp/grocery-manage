<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Services\Item\Actions\CreateItemAct;
use App\Services\Item\Actions\DeleteItemAct;
use App\Services\Item\Actions\EditItemAct;
use App\Services\Item\Actions\FillDatatableByCompanyAct;
use App\Services\Item\Actions\GetItemsByCategoryIdAct;
use App\Services\Item\Actions\GetStockAct;
use App\Services\Item\Actions\StoreItemAct;
use App\Services\Item\Actions\UpdateItemAct;

use App\Http\Requests;
use Illuminate\Http\Request;

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

    public function edit($id, EditItemAct $editItemAct)
    {
        list($item, $categories) = $editItemAct->run($id);
        return view('items.edit', ['item' => $item, 'categories' => $categories]);
    }

    public function update(UpdateItemRequest $request, $id, UpdateItemAct $updateItemAct)
    {
        $updateItemAct->run($id, $request->all());
        return redirect()->route('item.index')->with('success', 'Cập nhật thành công!!');
    }

    public function destroy($id, DeleteItemAct $deleteItemAct)
    {
        $deleteItemAct->run($id);
    }

    public function create(CreateItemAct $createItemAct)
    {
        $categories = $createItemAct->run();

        return view('items.create', ['categories' => $categories]);
    }

    public function store(StoreItemRequest $request, StoreItemAct $storeItemAct)
    {
        $storeItemAct->run($request->all());

        return redirect()->route('item.index')->with('success', 'Thêm sản phẩm mới thành công!!');
    }

    public function getItemByCategoryId($categoryId, GetItemsByCategoryIdAct $listItemAct)
    {
        if (request()->ajax()) {
            $items = $listItemAct->run($categoryId);
            return $items;
        }
    }

    public function stock()
    {
        return view('items.stock');
    }

    public function getStock(Request $request, GetStockAct $getStockAct)
    {
        return $getStockAct->run($request->all());
    }
}
