<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePurchaseReceiptRequest;
use App\Services\PurchaseReceipt\Actions\DeletePurchaseReceiptAct;
use App\Services\PurchaseReceipt\Actions\EditPurchaseReceiptAct;
use App\Services\PurchaseReceipt\Actions\FillDatatableByCompanyAct;
use App\Http\Requests;
use App\Http\Requests\StorePurchaseReceiptRequest;
use App\Services\PurchaseReceipt\Actions\CreatePurchaseReceiptAct;
use App\Services\PurchaseReceipt\Actions\GetPurchaseReceiptDetailByPurchaseReceiptIdAct;
use App\Services\PurchaseReceipt\Actions\StorePurchaseReceiptAct;
use App\Services\PurchaseReceipt\Actions\UpdatePurchaseReceiptAct;
use Illuminate\Http\Request;

class PurchaseReceiptController extends Controller
{
    public function index()
    {
        return view('purchaseReceipts.index');
    }

    public function fillDatatable(FillDatatableByCompanyAct $datatable, Request $request)
    {
        return $datatable->run($request->all());
    }

    public function edit($id, EditPurchaseReceiptAct $editPurchaseReceiptAct)
    {
        list($categories, $suppliers, $currentPurchase) = $editPurchaseReceiptAct->run($id);

        return view('purchaseReceipts.edit', compact('categories', 'suppliers', 'currentPurchase'));
    }

    public function update(UpdatePurchaseReceiptRequest $request, $id, UpdatePurchaseReceiptAct $updatePurchaseReceiptAct)
    {
        $result = $updatePurchaseReceiptAct->run($request->all(), $id);
        if (!$result) {
            return response()->json(['error' => ['Lỗi rồi']], 422);
        }
    }

    public function destroy($id, DeletePurchaseReceiptAct $deletePurchaseReceiptAct)
    {
        $deletePurchaseReceiptAct->run($id);
    }

    public function create(CreatePurchaseReceiptAct $createPurchaseReceiptAct)
    {
        list($categories, $suppliers) = $createPurchaseReceiptAct->run();

        return view('purchaseReceipts.create', compact('categories', 'suppliers'));
    }

    public function store(StorePurchaseReceiptRequest $request, StorePurchaseReceiptAct $storePurchaseReceiptAct)
    {
        if ($request->ajax()) {
            $result = $storePurchaseReceiptAct->run($request->all());
            if (!$result) {
                return response()->json(['error' => ['Lỗi rồi']], 422);
            }
        }
    }

    public function getPurchaseReceiptDetail($id, GetPurchaseReceiptDetailByPurchaseReceiptIdAct $getPurchaseReceiptDetailByPurchaseReceiptIdAct)
    {
        if (request()->ajax()) {
            return $getPurchaseReceiptDetailByPurchaseReceiptIdAct->run($id);
        }
    }
}
