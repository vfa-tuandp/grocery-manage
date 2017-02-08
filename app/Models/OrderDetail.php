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

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function getPriceAttribute($price)
    {
        return number_format($price, 0, ',', '.');
    }

    public function getSumAttribute($sum)
    {
        return number_format($sum, 0, ',', '.');
    }

    public function getReductionOnItemAttribute($reductionOnItem)
    {
        return number_format($reductionOnItem, 0, ',', '.');
    }

    public function getOtherCostOnItemAttribute($otherCostOnItem)
    {
        return number_format($otherCostOnItem, 0, ',', '.');
    }
}
