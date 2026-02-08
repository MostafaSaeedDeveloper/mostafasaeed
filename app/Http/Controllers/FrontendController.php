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
use Illuminate\Http\Request;
use Illuminate\View\View;

class FrontendController extends Controller
{
    public function home(): View
    {
        $profile = Profile::first();
        $projects = Project::where('status', 'published')->latest()->limit(6)->get();
        $clients = Client::where('featured', true)->orderBy('order')->get();
        $settings = Setting::first();

        return view('frontend.home', [
            'profile' => $profile,
            'projects' => $projects,
            'clients' => $clients,
            'settings' => $settings,
            'services' => $this->portfolioServices(),
            'experiences' => $this->experiences(),
        ]);
    }

    public function about(): View
    {
        $profile = Profile::first();
        $settings = Setting::first();

        return view('frontend.about', compact('profile', 'settings'));
    }

    public function services(): View
    {
        $settings = Setting::first();

        return view('frontend.services', [
            'services' => $this->portfolioServices(),
            'settings' => $settings,
        ]);
    }

    public function projects(Request $request): View
    {
        $query = Project::where('status', 'published')->latest();

        if ($request->filled('service_type')) {
            $query->where('category', $request->string('service_type')->toString());
        }

        $projects = $query->get();
        $serviceTypes = Project::where('status', 'published')
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');
        $settings = Setting::first();

        return view('frontend.projects', compact('projects', 'settings', 'serviceTypes'));
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

    private function portfolioServices(): array
    {
        return [
            ['title' => 'Web Development', 'description' => 'Building robust websites and web applications with clean architecture and long-term maintainability.'],
            ['title' => 'Custom Systems & Dashboards', 'description' => 'Designing tailored systems, admin dashboards, and workflows that match your exact business operations.'],
            ['title' => 'SEO Optimization', 'description' => 'Improving technical SEO, structure, and content signals to help your business rank and scale organically.'],
            ['title' => 'Social Media Management', 'description' => 'Planning and managing social content with a clear brand voice and measurable engagement goals.'],
            ['title' => 'Media Buying', 'description' => 'Running focused paid campaigns with practical targeting, budget control, and performance-driven optimization.'],
            ['title' => 'Graphic Design', 'description' => 'Creating modern visual assets and brand materials that align with your digital identity.'],
            ['title' => 'Maintenance & Technical Support', 'description' => 'Providing reliable updates, troubleshooting, and proactive technical support for long-term stability.'],
        ];
    }

    private function experiences(): array
    {
        return [
            ['title' => 'Full Stack Web Developer', 'company' => 'Bishop Integrated Solutions', 'period' => '2021 – Present', 'description' => 'Leading end-to-end development of scalable business platforms, integrating backend architecture with practical user-focused frontends.'],
            ['title' => 'Full Stack Web Developer', 'company' => 'Emtiaz Soft – UAE (Remote)', 'period' => 'Nov 2024 – Apr 2025', 'description' => 'Delivered remote full-stack implementations for client portals and internal tools with a focus on performance and maintainability.'],
            ['title' => 'WordPress Developer', 'company' => 'Withaq – Saudi Arabia (Remote)', 'period' => '2019 – 2022', 'description' => 'Developed and customized WordPress websites for business use-cases, ensuring responsive UI, SEO-readiness, and reliable delivery cycles.'],
            ['title' => 'WordPress Developer', 'company' => 'MWheba Agency', 'period' => '2019 – 2020', 'description' => 'Built and maintained WordPress projects for agency clients, handling theme customization and content-oriented performance improvements.'],
            ['title' => 'WordPress Developer', 'company' => 'WEGO Station', 'period' => '2019', 'description' => 'Contributed to production websites and landing pages with a strong focus on consistent branding and clean implementation.'],
            ['title' => 'WordPress Developer', 'company' => 'Mediabyte', 'period' => '2018', 'description' => 'Supported WordPress development workflows, implementing functional pages and optimizations aligned with project requirements.'],
            ['title' => 'WordPress Developer', 'company' => 'Aaser Media', 'period' => '2017', 'description' => 'Started professional delivery of WordPress websites, collaborating on deployment, custom features, and technical issue resolution.'],
        ];
    }
}
