<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Service;
use App\Models\Setting;

class HomeController extends Controller
{
    public function __invoke()
    {
        return view('site.home', [
            'profile' => Profile::query()->first(),
            'services' => Service::query()->where('is_active', true)->orderBy('display_order')->get(),
            'projects' => Project::query()->where('is_published', true)->orderByDesc('is_featured')->take(6)->get(),
            'clients' => Client::query()->where('is_featured', true)->orderBy('display_order')->get(),
            'settings' => Setting::query()->first(),
        ]);
    }
}
