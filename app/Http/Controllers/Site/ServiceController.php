<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Service;

class ServiceController extends Controller
{
    public function __invoke()
    {
        return view('site.services', [
            'services' => Service::query()->where('is_active', true)->orderBy('display_order')->get(),
        ]);
    }
}
