@extends('layouts.admin')

@section('title', __('app.site_settings'))

@section('content')
@php($setting = $setting ?? new \App\Models\Setting())
<form method="POST" action="{{ route('admin.settings.update') }}" class="card p-4" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">{{ __('app.site_name_en') }}</label>
            <input type="text" name="site_name_en" class="form-control" value="{{ old('site_name_en', $setting->site_name['en'] ?? '') }}" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">{{ __('app.site_name_ar') }}</label>
            <input type="text" name="site_name_ar" class="form-control" value="{{ old('site_name_ar', $setting->site_name['ar'] ?? '') }}" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">{{ __('app.logo') }}</label>
            <input type="file" name="logo" class="form-control">
            @if(!empty($setting->logo_path))
                <small class="text-muted">{{ $setting->logo_path }}</small>
            @endif
        </div>
        <div class="col-md-6">
            <label class="form-label">{{ __('app.contact_email') }}</label>
            <input type="email" name="contact_email" class="form-control" value="{{ old('contact_email', $setting->contact_email ?? '') }}">
        </div>
        <div class="col-md-6">
            <label class="form-label">{{ __('app.contact_phone') }}</label>
            <input type="text" name="contact_phone" class="form-control" value="{{ old('contact_phone', $setting->contact_phone ?? '') }}">
        </div>
        <div class="col-md-6">
            <label class="form-label">{{ __('app.base_currency') }}</label>
            <select name="base_currency_id" class="form-select">
                <option value="">{{ __('app.choose_currency') }}</option>
                @foreach($currencies as $currency)
                    <option value="{{ $currency->id }}" @selected(old('base_currency_id', $setting->base_currency_id ?? '') == $currency->id)>
                        {{ $currency->code }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label">{{ __('app.address_en') }}</label>
            <textarea name="address_en" class="form-control">{{ old('address_en', $setting->contact_address['en'] ?? '') }}</textarea>
        </div>
        <div class="col-md-6">
            <label class="form-label">{{ __('app.address_ar') }}</label>
            <textarea name="address_ar" class="form-control">{{ old('address_ar', $setting->contact_address['ar'] ?? '') }}</textarea>
        </div>
        <div class="col-md-6">
            <label class="form-label">{{ __('app.seo_title_en') }}</label>
            <input type="text" name="default_seo_title_en" class="form-control" value="{{ old('default_seo_title_en', $setting->default_seo['title']['en'] ?? '') }}">
        </div>
        <div class="col-md-6">
            <label class="form-label">{{ __('app.seo_title_ar') }}</label>
            <input type="text" name="default_seo_title_ar" class="form-control" value="{{ old('default_seo_title_ar', $setting->default_seo['title']['ar'] ?? '') }}">
        </div>
        <div class="col-md-6">
            <label class="form-label">{{ __('app.seo_description_en') }}</label>
            <textarea name="default_seo_description_en" class="form-control">{{ old('default_seo_description_en', $setting->default_seo['description']['en'] ?? '') }}</textarea>
        </div>
        <div class="col-md-6">
            <label class="form-label">{{ __('app.seo_description_ar') }}</label>
            <textarea name="default_seo_description_ar" class="form-control">{{ old('default_seo_description_ar', $setting->default_seo['description']['ar'] ?? '') }}</textarea>
        </div>
    </div>
    <button class="btn btn-primary mt-3">{{ __('app.save') }}</button>
</form>
@endsection
