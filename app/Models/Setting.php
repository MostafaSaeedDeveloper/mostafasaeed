<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasTranslations;

    protected $fillable = [
        'site_name',
        'logo_path',
        'contact_email',
        'contact_phone',
        'contact_address',
        'social_links',
        'default_seo',
        'base_currency_id',
    ];

    protected $casts = [
        'site_name' => 'array',
        'contact_address' => 'array',
        'social_links' => 'array',
        'default_seo' => 'array',
    ];

    public function baseCurrency()
    {
        return $this->belongsTo(Currency::class, 'base_currency_id');
    }
}
