<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Profile;

class AboutController extends Controller
{
    public function __invoke()
    {
        return view('site.about', [
            'profile' => Profile::query()->first(),
        ]);
    }
}
