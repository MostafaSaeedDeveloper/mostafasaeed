<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'title',
        'date',
        'expense_date',
        'expense_category_id',
        'category',
        'amount',
        'currency_id',
        'exchange_rate_to_base',
        'account_id',
        'vendor',
        'receipt_path',
        'notes',
    ];

    protected $casts = [
        'date' => 'date',
        'expense_date' => 'date',
    ];

    public function categoryRelation()
    {
        return $this->belongsTo(ExpenseCategory::class, 'expense_category_id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
