<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Client;

class ClientController extends Controller
{
    public function __invoke()
    {
        return view('site.clients', [
            'clients' => Client::query()->orderBy('display_order')->get(),
        ]);
    }
}
