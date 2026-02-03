<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'symbol',
        'is_base',
        'is_enabled',
    ];

    protected $casts = [
        'is_base' => 'boolean',
        'is_enabled' => 'boolean',
    ];
}
