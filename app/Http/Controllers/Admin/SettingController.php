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

        if ($request->hasFile('favicon')) {
            $this->uploadService->delete($setting->favicon_path);
            $setting->favicon_path = $this->uploadService->store($request->file('favicon'), 'uploads/media');
        }

        $setting->update([
            'site_name' => [
                'en' => $request->input('site_name_en'),
                'ar' => $request->input('site_name_ar'),
            ],
            'brand_name' => $request->input('brand_name'),
            'logo_path' => $setting->logo_path,
            'favicon_path' => $setting->favicon_path,
            'contact_email' => $request->input('contact_email'),
            'contact_phone' => $request->input('contact_phone'),
            'tax_number' => $request->input('tax_number'),
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
            'currency_format' => $request->input('currency_format'),
            'timezone' => $request->input('timezone'),
            'date_format' => $request->input('date_format'),
            'invoice_prefix' => $request->input('invoice_prefix'),
            'invoice_start_number' => $request->integer('invoice_start_number'),
            'default_due_days' => $request->integer('default_due_days'),
            'invoice_terms' => $request->input('invoice_terms'),
            'invoice_notes' => $request->input('invoice_notes'),
            'invoice_template' => $request->input('invoice_template'),
            'tax_enabled' => $request->boolean('tax_enabled'),
            'default_tax_rate' => $request->input('default_tax_rate', 0),
            'tax_inclusive' => $request->boolean('tax_inclusive'),
            'allow_item_discount' => $request->boolean('allow_item_discount'),
            'allow_invoice_discount' => $request->boolean('allow_invoice_discount'),
            'invoice_email_template' => $request->input('invoice_email_template'),
            'overdue_notifications_enabled' => $request->boolean('overdue_notifications_enabled'),
        ]);

        return redirect()->route('admin.settings.edit')->with('success', __('app.saved_successfully'));
    }
}
