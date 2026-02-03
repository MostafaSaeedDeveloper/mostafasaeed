@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-semibold">{{ __('messages.settings') }}</h1>
    <form class="mt-6 rounded bg-white p-6 shadow" method="POST" action="{{ route('admin.settings.update') }}">
        @csrf
        @method('PUT')
        <div class="grid gap-4 md:grid-cols-2">
            <div>
                <label class="text-sm">{{ __('messages.site_name_en') }}</label>
                <input class="mt-1 w-full rounded border px-3 py-2" name="site_name[en]" value="{{ old('site_name.en', $settings?->site_name['en'] ?? '') }}">
            </div>
            <div>
                <label class="text-sm">{{ __('messages.site_name_ar') }}</label>
                <input class="mt-1 w-full rounded border px-3 py-2" name="site_name[ar]" value="{{ old('site_name.ar', $settings?->site_name['ar'] ?? '') }}">
            </div>
            <div>
                <label class="text-sm">{{ __('messages.logo') }}</label>
                <input class="mt-1 w-full rounded border px-3 py-2" name="logo" value="{{ old('logo', $settings?->logo) }}">
            </div>
            <div>
                <label class="text-sm">{{ __('messages.base_currency') }}</label>
                <select class="mt-1 w-full rounded border px-3 py-2" name="base_currency_id">
                    <option value="">{{ __('messages.select') }}</option>
                    @foreach($currencies as $currency)
                        <option value="{{ $currency->id }}" @selected(old('base_currency_id', $settings?->base_currency_id) == $currency->id)>{{ $currency->code }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <button class="mt-4 rounded bg-slate-900 px-4 py-2 text-white" type="submit">{{ __('messages.save') }}</button>
    </form>
@endsection
