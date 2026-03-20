<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'type',
        'description',
        'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];
}
