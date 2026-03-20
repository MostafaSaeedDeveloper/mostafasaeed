<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'invoice_number',
        'client_id',
        'customer_id',
        'project_id',
        'issue_date',
        'due_date',
        'currency_id',
        'currency',
        'exchange_rate_to_base',
        'status',
        'subtotal',
        'discount',
        'tax_percent',
        'tax_amount',
        'tax',
        'total',
        'paid_amount',
        'due_amount',
        'invoice_prefix',
        'notes',
    ];

    protected $casts = [
        'issue_date' => 'date',
        'due_date' => 'date',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function currencyModel()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function getFormattedNumberAttribute(): string
    {
        return (str_contains((string) $this->invoice_number, 'INV-') ? '' : 'INV-').$this->invoice_number;
    }
}
