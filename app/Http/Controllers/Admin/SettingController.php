<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Models\Currency;
use App\Models\Setting;
use App\Services\UploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function __construct(private readonly UploadService $uploadService)
    {
    }

    public function edit(): View
    {
        $setting = Setting::first();
        $currencies = Currency::where('enabled', true)->get();

        return view('admin.settings.edit', compact('setting', 'currencies'));
    }

    public function update(SettingRequest $request): RedirectResponse
    {
        $setting = Setting::firstOrCreate([]);

        if ($request->hasFile('logo')) {
            $this->uploadService->delete($setting->logo_path);
            $setting->logo_path = $this->uploadService->store($request->file('logo'), 'uploads/media');
        }

        $setting->update([
            'site_name' => [
                'en' => $request->input('site_name_en'),
                'ar' => $request->input('site_name_ar'),
            ],
            'logo_path' => $setting->logo_path,
            'contact_email' => $request->input('contact_email'),
            'contact_phone' => $request->input('contact_phone'),
            'contact_address' => [
                'en' => $request->input('address_en'),
                'ar' => $request->input('address_ar'),
            ],
            'social_links' => $request->input('social_links', []),
            'default_seo' => [
                'title' => [
                    'en' => $request->input('default_seo_title_en'),
                    'ar' => $request->input('default_seo_title_ar'),
                ],
                'description' => [
                    'en' => $request->input('default_seo_description_en'),
                    'ar' => $request->input('default_seo_description_ar'),
                ],
            ],
            'base_currency_id' => $request->input('base_currency_id'),
        ]);

        return redirect()->route('admin.settings.edit')->with('success', __('app.saved_successfully'));
    }
}
