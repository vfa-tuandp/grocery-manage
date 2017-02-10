<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseReceipt extends Model
{
    protected $fillable = [
        'datetime',
        'supplier_id',
        'company_id',
        'total',
        'other_cost',
        'reduction',
        'note',
        'vat',
    ];

    protected $dates = [
        'datetime'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function purchaseReceiptDetails()
    {
        return $this->hasMany(PurchaseReceiptDetail::class);
    }

    public function cashFlow()
    {
        return $this->morphOne(CashFlow::class, 'cashflowable');
    }
}
