<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasTranslations;

    protected $fillable = [
        'title',
        'slug',
        'summary',
        'case_study',
        'tech_stack',
        'category',
        'main_image_path',
        'live_url',
        'repo_url',
        'metrics',
        'featured',
        'status',
        'seo_meta',
        'customer_id',
    ];

    protected $casts = [
        'title' => 'array',
        'summary' => 'array',
        'case_study' => 'array',
        'tech_stack' => 'array',
        'metrics' => 'array',
        'featured' => 'boolean',
        'seo_meta' => 'array',
    ];

    public function images()
    {
        return $this->hasMany(ProjectImage::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
