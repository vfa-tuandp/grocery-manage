<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CashFlow extends Model
{
    CONST CHI = 1;
    CONST THU = 0;

    CONST TYPE_ORDER = 'order';
    const TYPE_PURCHASE = 'purchase';

    protected $fillable = ['company_id', 'datetime', 'content', 'value', 'note', 'type'];

    public function cashflowable()
    {
        return $this->morphTo();
    }
}
