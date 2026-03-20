@extends('layouts.admin')
@section('title', 'Site Settings')
@section('page_title', 'Site Settings')
@section('content')
@php($setting = $setting ?? new \App\Models\Setting())
<form method="POST" action="{{ route('admin.settings.update') }}" class="card p-4">@csrf @method('PUT')
<div class="row g-3">
    <div class="col-md-6"><label class="form-label">Site Name (EN)</label><input type="text" name="site_name_en" class="form-control" value="{{ old('site_name_en', $setting->site_name['en'] ?? 'Mostafa Saeed') }}" required></div>
    <div class="col-md-6"><label class="form-label">Site Name (AR)</label><input type="text" name="site_name_ar" class="form-control" value="{{ old('site_name_ar', $setting->site_name['ar'] ?? 'مصطفى سعيد') }}" required></div>
    <div class="col-md-6"><label class="form-label">Brand Name</label><input type="text" name="brand_name" class="form-control" value="{{ old('brand_name', $setting->brand_name ?? 'Mostafa Saeed') }}" required></div>
    <div class="col-md-6"><label class="form-label">Contact Email</label><input type="email" name="contact_email" class="form-control" value="{{ old('contact_email', $setting->contact_email ?? 'admin@mostafasaeed.com') }}" required></div>
    <div class="col-md-6"><label class="form-label">Phone</label><input type="text" name="contact_phone" class="form-control" value="{{ old('contact_phone', $setting->contact_phone ?? '01003770730') }}" required></div>
    <div class="col-md-6"><label class="form-label">Currency</label><select name="base_currency_id" class="form-select">@foreach($currencies as $currency)<option value="{{ $currency->id }}" @selected(old('base_currency_id', $setting->base_currency_id)==$currency->id)>{{ $currency->code }}</option>@endforeach</select></div>
    <div class="col-md-6"><label class="form-label">Address (EN)</label><textarea name="address_en" class="form-control" required>{{ old('address_en', $setting->contact_address['en'] ?? 'Alexandria, Egypt') }}</textarea></div>
    <div class="col-md-6"><label class="form-label">Address (AR)</label><textarea name="address_ar" class="form-control" required>{{ old('address_ar', $setting->contact_address['ar'] ?? 'الإسكندرية، مصر') }}</textarea></div>
    <div class="col-md-6"><label class="form-label">Invoice Prefix</label><input type="text" name="invoice_prefix" class="form-control" value="{{ old('invoice_prefix', $setting->invoice_prefix ?? 'INV-') }}" required></div>
    <div class="col-md-6"><label class="form-label">Default Tax Percentage</label><input type="number" step="0.01" name="default_tax_rate" class="form-control" value="{{ old('default_tax_rate', $setting->default_tax_rate ?? 0) }}"></div>
</div><div class="mt-3"><button class="btn btn-primary">Save Settings</button></div></form>
@endsection
