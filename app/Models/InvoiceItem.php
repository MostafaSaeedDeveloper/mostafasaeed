<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    protected $fillable = [
        'invoice_id',
        'name',
        'qty',
        'unit_price',
        'line_discount',
        'line_total',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
