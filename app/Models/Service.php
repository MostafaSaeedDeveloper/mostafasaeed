<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasTranslations;

    protected $fillable = [
        'title',
        'short_description',
        'description',
        'icon',
        'order',
        'status',
        'seo_meta',
    ];

    protected $casts = [
        'title' => 'array',
        'short_description' => 'array',
        'description' => 'array',
        'seo_meta' => 'array',
    ];
}
