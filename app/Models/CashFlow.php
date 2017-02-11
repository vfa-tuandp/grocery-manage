<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CashFlow extends Model
{
    const CHI = 1;
    const THU = 0;

    const TYPE_ORDER = 'order';
    const TYPE_PURCHASE = 'purchase';

    protected $fillable = ['company_id', 'datetime', 'content', 'value', 'note', 'type'];

    protected $dates = [
        'datetime'
    ];
    
    public function cashflowable()
    {
        return $this->morphTo();
    }
}
