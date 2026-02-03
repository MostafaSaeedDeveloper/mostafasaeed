<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasTranslations;

    protected $fillable = [
        'name',
        'titles',
        'bio',
        'skills',
        'profile_image_path',
        'cv_path',
        'social_links',
    ];

    protected $casts = [
        'titles' => 'array',
        'bio' => 'array',
        'skills' => 'array',
        'social_links' => 'array',
    ];
}
