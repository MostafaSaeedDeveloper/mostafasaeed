<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        'name',
        'type',
        'opening_balance',
        'currency_id',
    ];

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}
