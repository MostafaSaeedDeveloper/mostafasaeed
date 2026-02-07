<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $fillable = [
        'name',
        'email',
        'service',
        'message',
        'ip_address',
        'user_agent',
        'status',
    ];
}
