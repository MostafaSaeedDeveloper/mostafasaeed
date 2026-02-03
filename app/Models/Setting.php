<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_name',
        'logo',
        'social_links',
        'contact_info',
        'default_seo',
        'base_currency_id',
    ];

    protected $casts = [
        'site_name' => 'array',
        'social_links' => 'array',
        'contact_info' => 'array',
        'default_seo' => 'array',
    ];

    public function baseCurrency()
    {
        return $this->belongsTo(Currency::class, 'base_currency_id');
    }
}
