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
        'brand_name',
        'favicon_path',
        'tax_number',
        'currency_format',
        'timezone',
        'date_format',
        'invoice_prefix',
        'invoice_start_number',
        'default_due_days',
        'invoice_terms',
        'invoice_notes',
        'invoice_template',
        'tax_enabled',
        'default_tax_rate',
        'tax_inclusive',
        'allow_item_discount',
        'allow_invoice_discount',
        'invoice_email_template',
        'overdue_notifications_enabled',
    ];

    protected $casts = [
        'site_name' => 'array',
        'contact_address' => 'array',
        'social_links' => 'array',
        'default_seo' => 'array',
        'tax_enabled' => 'boolean',
        'tax_inclusive' => 'boolean',
        'allow_item_discount' => 'boolean',
        'allow_invoice_discount' => 'boolean',
        'overdue_notifications_enabled' => 'boolean',
    ];

    public function baseCurrency()
    {
        return $this->belongsTo(Currency::class, 'base_currency_id');
    }
}
