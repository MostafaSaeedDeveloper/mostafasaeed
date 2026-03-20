<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasTranslations;
    use SoftDeletes;

    protected $fillable = [
        'client_id',
        'title',
        'slug',
        'description',
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
        'start_date',
        'end_date',
        'budget',
        'notes',
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
        'start_date' => 'date',
        'end_date' => 'date',
        'budget' => 'decimal:2',
    ];

    public function images()
    {
        return $this->hasMany(ProjectImage::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
