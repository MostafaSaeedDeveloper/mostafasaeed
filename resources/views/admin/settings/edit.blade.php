@extends('layouts.admin')
@section('title', __('app.site_settings'))
@section('page_title', 'System Settings')
@section('breadcrumb')
<ol class="breadcrumb float-sm-right"><li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li><li class="breadcrumb-item active">Settings</li></ol>
@endsection
@section('content')
@php($setting = $setting ?? new \App\Models\Setting())
<form method="POST" action="{{ route('admin.settings.update') }}" class="card card-primary card-outline" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="card-body">
        <h5>Company & Brand</h5>
        <div class="row g-3">
            <div class="col-md-4"><label>Brand Name</label><input type="text" name="brand_name" class="form-control" value="{{ old('brand_name',$setting->brand_name) }}" required></div>
            <div class="col-md-4"><label>{{ __('app.site_name_en') }}</label><input type="text" name="site_name_en" class="form-control" value="{{ old('site_name_en', $setting->site_name['en'] ?? '') }}" required></div>
            <div class="col-md-4"><label>{{ __('app.site_name_ar') }}</label><input type="text" name="site_name_ar" class="form-control" value="{{ old('site_name_ar', $setting->site_name['ar'] ?? '') }}" required></div>
            <div class="col-md-6"><label>{{ __('app.logo') }}</label><input type="file" name="logo" class="form-control"></div>
            <div class="col-md-6"><label>Favicon</label><input type="file" name="favicon" class="form-control"></div>
            <div class="col-md-4"><label>Email</label><input type="email" name="contact_email" class="form-control" value="{{ old('contact_email', $setting->contact_email ?? '') }}"></div>
            <div class="col-md-4"><label>Mobile</label><input type="text" name="contact_phone" class="form-control" value="{{ old('contact_phone', $setting->contact_phone ?? '') }}"></div>
            <div class="col-md-4"><label>VAT / Tax Number</label><input type="text" name="tax_number" class="form-control" value="{{ old('tax_number', $setting->tax_number ?? '') }}"></div>
            <div class="col-md-6"><label>{{ __('app.address_en') }}</label><textarea name="address_en" class="form-control">{{ old('address_en', $setting->contact_address['en'] ?? '') }}</textarea></div>
            <div class="col-md-6"><label>{{ __('app.address_ar') }}</label><textarea name="address_ar" class="form-control">{{ old('address_ar', $setting->contact_address['ar'] ?? '') }}</textarea></div>
            <div class="col-md-3"><label>Base Currency</label><select name="base_currency_id" class="form-control"><option value="">Select</option>@foreach($currencies as $currency)<option value="{{ $currency->id }}" @selected(old('base_currency_id',$setting->base_currency_id)==$currency->id)>{{ $currency->code }}</option>@endforeach</select></div>
            <div class="col-md-3"><label>Currency Display</label><select name="currency_format" class="form-control"><option value="symbol" @selected(old('currency_format',$setting->currency_format ?? 'symbol')==='symbol')>Symbol</option><option value="code" @selected(old('currency_format',$setting->currency_format)==='code')>Code</option></select></div>
            <div class="col-md-3"><label>Timezone</label><input type="text" name="timezone" class="form-control" value="{{ old('timezone',$setting->timezone ?? 'Africa/Cairo') }}"></div>
            <div class="col-md-3"><label>Date Format</label><select name="date_format" class="form-control">@foreach(['Y-m-d','d/m/Y','m/d/Y','d M Y'] as $fmt)<option value="{{ $fmt }}" @selected(old('date_format',$setting->date_format ?? 'Y-m-d')===$fmt)>{{ $fmt }}</option>@endforeach</select></div>
        </div>

        <hr><h5>Invoice Settings</h5>
        <div class="row g-3">
            <div class="col-md-3"><label>Prefix</label><input name="invoice_prefix" class="form-control" value="{{ old('invoice_prefix',$setting->invoice_prefix ?? 'INV-') }}"></div>
            <div class="col-md-3"><label>Start Number</label><input type="number" min="1" name="invoice_start_number" class="form-control" value="{{ old('invoice_start_number',$setting->invoice_start_number ?? 1) }}"></div>
            <div class="col-md-3"><label>Default Due Days</label><input type="number" min="1" name="default_due_days" class="form-control" value="{{ old('default_due_days',$setting->default_due_days ?? 7) }}"></div>
            <div class="col-md-3"><label>Invoice Template</label><select name="invoice_template" class="form-control">@foreach(['classic','modern','minimal'] as $t)<option value="{{ $t }}" @selected(old('invoice_template',$setting->invoice_template ?? 'classic')===$t)>{{ ucfirst($t) }}</option>@endforeach</select></div>
            <div class="col-md-6"><label>Default Notes</label><textarea name="invoice_notes" class="form-control">{{ old('invoice_notes',$setting->invoice_notes) }}</textarea></div>
            <div class="col-md-6"><label>Terms & Conditions</label><textarea name="invoice_terms" class="form-control">{{ old('invoice_terms',$setting->invoice_terms) }}</textarea></div>
            <div class="col-md-2"><div class="custom-control custom-switch mt-4"><input class="custom-control-input" type="checkbox" id="tax_enabled" name="tax_enabled" value="1" @checked(old('tax_enabled',$setting->tax_enabled))><label class="custom-control-label" for="tax_enabled">Enable Tax</label></div></div>
            <div class="col-md-2"><label>Tax %</label><input type="number" step="0.01" name="default_tax_rate" class="form-control" value="{{ old('default_tax_rate',$setting->default_tax_rate ?? 0) }}"></div>
            <div class="col-md-2"><div class="custom-control custom-switch mt-4"><input class="custom-control-input" type="checkbox" id="tax_inclusive" name="tax_inclusive" value="1" @checked(old('tax_inclusive',$setting->tax_inclusive))><label class="custom-control-label" for="tax_inclusive">Tax Inclusive</label></div></div>
            <div class="col-md-3"><div class="custom-control custom-switch mt-4"><input class="custom-control-input" type="checkbox" id="allow_item_discount" name="allow_item_discount" value="1" @checked(old('allow_item_discount',$setting->allow_item_discount ?? true))><label class="custom-control-label" for="allow_item_discount">Item Discount</label></div></div>
            <div class="col-md-3"><div class="custom-control custom-switch mt-4"><input class="custom-control-input" type="checkbox" id="allow_invoice_discount" name="allow_invoice_discount" value="1" @checked(old('allow_invoice_discount',$setting->allow_invoice_discount ?? true))><label class="custom-control-label" for="allow_invoice_discount">Invoice Discount</label></div></div>
        </div>

        <hr><h5>Email & Notifications</h5>
        <div class="row g-3">
            <div class="col-md-9"><label>Email Template</label><textarea name="invoice_email_template" class="form-control" rows="4">{{ old('invoice_email_template',$setting->invoice_email_template) }}</textarea></div>
            <div class="col-md-3"><div class="custom-control custom-switch mt-4"><input class="custom-control-input" type="checkbox" id="overdue_notifications_enabled" name="overdue_notifications_enabled" value="1" @checked(old('overdue_notifications_enabled',$setting->overdue_notifications_enabled))><label class="custom-control-label" for="overdue_notifications_enabled">Overdue Alerts</label></div></div>
        </div>
    </div>
    <div class="card-footer text-right"><button class="btn btn-primary">{{ __('app.save') }}</button></div>
</form>
@endsection
