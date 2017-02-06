<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'datetime',
        'customer_id',
        'company_id',
        'total',
        'other_cost',
        'reduction',
        'note',
    ];

    protected $dates = [
        'datetime'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
