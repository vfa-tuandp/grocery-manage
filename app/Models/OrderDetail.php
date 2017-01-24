<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [
        'item_id',
        'order_id',
        'quantity',
        'price',
        'reduction_on_item',
        'other_cost_on_item',
        'note_on_item',
        'sum'
    ];
}
