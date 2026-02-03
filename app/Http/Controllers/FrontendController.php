<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactMessageRequest;
use App\Models\Client;
use App\Models\ContactMessage;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FrontendController extends Controller
{
    public function home(): View
    {
        $profile = Profile::first();
        $services = Service::where('status', 'published')->orderBy('order')->limit(5)->get();
        $projects = Project::where('status', 'published')->latest()->limit(6)->get();
        $clients = Client::where('featured', true)->orderBy('order')->get();
        $settings = Setting::first();

        return view('frontend.home', compact('profile', 'services', 'projects', 'clients', 'settings'));
    }

    public function about(): View
    {
        $profile = Profile::first();
        $settings = Setting::first();

        return view('frontend.about', compact('profile', 'settings'));
    }

    public function services(): View
    {
        $services = Service::where('status', 'published')->orderBy('order')->get();
        $settings = Setting::first();

        return view('frontend.services', compact('services', 'settings'));
    }

    public function projects(): View
    {
        $projects = Project::where('status', 'published')->latest()->get();
        $settings = Setting::first();

        return view('frontend.projects', compact('projects', 'settings'));
    }

    public function projectShow(string $slug): View
    {
        $project = Project::with('images')->where('slug', $slug)->where('status', 'published')->firstOrFail();
        $settings = Setting::first();

        return view('frontend.project-show', compact('project', 'settings'));
    }

    public function clients(): View
    {
        $clients = Client::where('featured', true)->orderBy('order')->get();
        $settings = Setting::first();

        return view('frontend.clients', compact('clients', 'settings'));
    }

    public function contact(): View
    {
        $services = Service::where('status', 'published')->orderBy('order')->get();
        $settings = Setting::first();

        return view('frontend.contact', compact('services', 'settings'));
    }

    public function storeContact(StoreContactMessageRequest $request): RedirectResponse
    {
        if ($request->filled('website')) {
            return back()->with('success', __('app.contact_thanks'));
        }

        ContactMessage::create([
            'name' => $request->string('name')->toString(),
            'email' => $request->string('email')->toString(),
            'service' => $request->string('service')->toString(),
            'message' => $request->string('message')->toString(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return back()->with('success', __('app.contact_thanks'));
    }

    public function sitemap(): View
    {
        $projects = Project::where('status', 'published')->get();

        return response()
            ->view('frontend.sitemap', compact('projects'))
            ->header('Content-Type', 'application/xml');
    }
}
