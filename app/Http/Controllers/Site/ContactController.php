<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Models\ContactMessage;
use App\Models\Service;

class ContactController extends Controller
{
    public function index()
    {
        return view('site.contact', [
            'services' => Service::query()->where('is_active', true)->orderBy('display_order')->get(),
        ]);
    }

    public function store(ContactRequest $request)
    {
        if ($request->filled('website')) {
            return redirect()->back();
        }

        ContactMessage::create($request->safe()->except('website'));

        return redirect()->back()->with('status', __('messages.contact_thanks'));
    }
}
