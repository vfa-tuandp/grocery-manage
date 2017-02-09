<?php

namespace App\Repositories\PurchaseReceipt;

use App\Models\PurchaseReceipt;
use App\Repositories\MyBaseRepository;

/**
 * Class PurchaseReceiptRepositoryEloquent
 * @package namespace App\Repositories;
 */
class PurchaseReceiptRepoEloquent extends MyBaseRepository implements PurchaseReceiptRepo
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PurchaseReceipt::class;
    }

    public function getPurchaseQuery($companyId)
    {
        return \DB::table('purchase_receipts')
            ->leftJoin('suppliers', function ($join) {
                $join->on('purchase_receipts.supplier_id', '=', 'suppliers.id');
            })->leftJoin('purchase_receipt_details', function ($join) {
                $join->on('purchase_receipts.id', '=', 'purchase_receipt_details.purchase_receipt_id');
            })->join('items', function ($join) {
                $join->on('items.id', '=', 'purchase_receipt_details.item_id');
            })->join('categories', function ($join) {
                $join->on('items.category_id', '=', 'categories.id');
            })->where('purchase_receipts.company_id', '=', $companyId)
            ->select([
                'datetime',
                'categories.name as category_name',
                'items.name as item_name',
                'items.unit as unit',
                'purchase_receipt_details.quantity',
                'suppliers.name as target_name',
                \DB::raw("'Nhập' as kind")
            ]);
    }
}
