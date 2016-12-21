<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
      'name',
      'unit',
      'category_id',
      'company_id',
      'check_in_stock',
      'in_stock',
      'price_in_hint',
      'price_out_hint',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
