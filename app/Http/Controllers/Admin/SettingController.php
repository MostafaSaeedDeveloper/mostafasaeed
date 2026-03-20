<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Models\Currency;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function edit(): View
    {
        return view('admin.settings.edit', [
            'setting' => Setting::first(),
            'currencies' => Currency::orderBy('code')->get(),
        ]);
    }

    public function update(SettingRequest $request): RedirectResponse
    {
        $setting = Setting::firstOrCreate([]);
        $setting->update([
            'site_name' => ['en' => $request->input('site_name_en'), 'ar' => $request->input('site_name_ar')],
            'brand_name' => $request->input('brand_name'),
            'contact_email' => $request->input('contact_email'),
            'contact_phone' => $request->input('contact_phone'),
            'contact_address' => ['en' => $request->input('address_en'), 'ar' => $request->input('address_ar')],
            'base_currency_id' => $request->input('base_currency_id'),
            'invoice_prefix' => $request->input('invoice_prefix'),
            'default_tax_rate' => $request->input('default_tax_rate', 0),
        ]);

        return redirect()->route('admin.settings.edit')->with('success', __('app.saved_successfully'));
    }
}
