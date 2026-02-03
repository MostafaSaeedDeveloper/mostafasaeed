<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'summary',
        'case_study',
        'tech_stack',
        'category',
        'client_id',
        'live_url',
        'repo_url',
        'metrics',
        'is_featured',
        'is_published',
        'seo',
    ];

    protected $casts = [
        'title' => 'array',
        'summary' => 'array',
        'case_study' => 'array',
        'tech_stack' => 'array',
        'metrics' => 'array',
        'seo' => 'array',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function images()
    {
        return $this->hasMany(ProjectImage::class);
    }
}
