<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'company_name',
        'phone',
        'email',
        'address',
        'country',
        'tax_number',
        'default_currency_id',
        'notes',
        'status',
    ];

    public function notes()
    {
        return $this->hasMany(CustomerNote::class);
    }

    public function tasks()
    {
        return $this->hasMany(CustomerTask::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function defaultCurrency()
    {
        return $this->belongsTo(Currency::class, 'default_currency_id');
    }
}
