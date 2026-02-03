<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = [
        'code',
        'symbol',
        'is_base',
        'enabled',
        'exchange_rate',
    ];

    protected $casts = [
        'is_base' => 'boolean',
        'enabled' => 'boolean',
        'exchange_rate' => 'decimal:6',
    ];
}
