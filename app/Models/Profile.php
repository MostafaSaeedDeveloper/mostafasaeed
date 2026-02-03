<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'titles',
        'bio',
        'skills',
        'profile_image',
        'cv_path',
    ];

    protected $casts = [
        'titles' => 'array',
        'bio' => 'array',
        'skills' => 'array',
    ];
}
