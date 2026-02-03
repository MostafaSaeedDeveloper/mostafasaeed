<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revenue extends Model
{
    use HasFactory;

    protected $fillable = [
        'received_at',
        'source',
        'amount',
        'currency_id',
        'exchange_rate',
        'account_id',
        'notes',
    ];

    protected $casts = [
        'received_at' => 'date',
    ];

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
