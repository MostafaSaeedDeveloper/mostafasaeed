<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'company',
        'phone',
        'email',
        'address',
        'country',
        'tax_number',
        'currency_id',
        'notes',
        'status',
    ];

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function notes()
    {
        return $this->hasMany(CustomerNote::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
