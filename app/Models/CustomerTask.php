<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerTask extends Model
{
    protected $fillable = [
        'customer_id',
        'assigned_to',
        'title',
        'due_date',
        'status',
    ];

    protected $casts = [
        'due_date' => 'date',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
