<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Models\Currency;
use App\Models\Setting;

class SettingController extends Controller
{
    public function edit()
    {
        return view('admin.settings', [
            'settings' => Setting::query()->first(),
            'currencies' => Currency::query()->orderBy('code')->get(),
        ]);
    }

    public function update(SettingRequest $request)
    {
        $settings = Setting::query()->firstOrNew();
        $settings->fill($request->validated());
        $settings->save();

        return redirect()->back()->with('status', __('messages.saved'));
    }
}
