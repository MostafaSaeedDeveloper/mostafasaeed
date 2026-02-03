<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        $services = Service::orderBy('order')->get();

        return view('admin.services.index', compact('services'));
    }

    public function create(): View
    {
        return view('admin.services.create');
    }

    public function store(ServiceRequest $request): RedirectResponse
    {
        Service::create([
            'title' => ['en' => $request->string('title_en')->toString(), 'ar' => $request->string('title_ar')->toString()],
            'short_description' => ['en' => $request->input('short_description_en'), 'ar' => $request->input('short_description_ar')],
            'description' => ['en' => $request->input('description_en'), 'ar' => $request->input('description_ar')],
            'icon' => $request->input('icon'),
            'order' => $request->input('order', 0),
            'status' => $request->input('status', 'draft'),
            'seo_meta' => [
                'title' => ['en' => $request->input('seo_title_en'), 'ar' => $request->input('seo_title_ar')],
                'description' => ['en' => $request->input('seo_description_en'), 'ar' => $request->input('seo_description_ar')],
            ],
        ]);

        return redirect()->route('admin.services.index')->with('success', __('app.saved_successfully'));
    }

    public function edit(Service $service): View
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(ServiceRequest $request, Service $service): RedirectResponse
    {
        $service->update([
            'title' => ['en' => $request->string('title_en')->toString(), 'ar' => $request->string('title_ar')->toString()],
            'short_description' => ['en' => $request->input('short_description_en'), 'ar' => $request->input('short_description_ar')],
            'description' => ['en' => $request->input('description_en'), 'ar' => $request->input('description_ar')],
            'icon' => $request->input('icon'),
            'order' => $request->input('order', 0),
            'status' => $request->input('status', 'draft'),
            'seo_meta' => [
                'title' => ['en' => $request->input('seo_title_en'), 'ar' => $request->input('seo_title_ar')],
                'description' => ['en' => $request->input('seo_description_en'), 'ar' => $request->input('seo_description_ar')],
            ],
        ]);

        return redirect()->route('admin.services.index')->with('success', __('app.saved_successfully'));
    }

    public function destroy(Service $service): RedirectResponse
    {
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', __('app.deleted_successfully'));
    }
}
