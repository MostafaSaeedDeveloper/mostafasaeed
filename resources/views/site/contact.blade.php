@extends('layouts.site')

@section('content')
    <h1 class="text-3xl font-semibold">{{ __('messages.contact') }}</h1>
    <form class="mt-6 rounded bg-white p-6 shadow" method="POST" action="{{ route('contact.store') }}">
        @csrf
        <div class="grid gap-4 md:grid-cols-2">
            <div>
                <label class="text-sm" for="name">{{ __('messages.name') }}</label>
                <input class="mt-1 w-full rounded border border-slate-300 px-3 py-2" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="text-sm" for="email">{{ __('messages.email') }}</label>
                <input class="mt-1 w-full rounded border border-slate-300 px-3 py-2" id="email" name="email" type="email" value="{{ old('email') }}" required>
                @error('email')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div class="md:col-span-2">
                <label class="text-sm" for="service">{{ __('messages.service') }}</label>
                <select class="mt-1 w-full rounded border border-slate-300 px-3 py-2" id="service" name="service">
                    <option value="">{{ __('messages.select_service') }}</option>
                    @foreach($services as $service)
                        <option value="{{ $service->title[app()->getLocale()] ?? '' }}">{{ $service->title[app()->getLocale()] ?? '' }}</option>
                    @endforeach
                </select>
            </div>
            <div class="md:col-span-2">
                <label class="text-sm" for="message">{{ __('messages.message') }}</label>
                <textarea class="mt-1 w-full rounded border border-slate-300 px-3 py-2" id="message" name="message" rows="4" required>{{ old('message') }}</textarea>
                @error('message')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
        </div>
        <input type="text" name="website" class="hidden" tabindex="-1" autocomplete="off">
        <button class="mt-4 rounded bg-slate-900 px-4 py-2 text-white" type="submit">{{ __('messages.send') }}</button>
        @if(session('status'))
            <p class="mt-2 text-sm text-emerald-600">{{ session('status') }}</p>
        @endif
    </form>
@endsection
