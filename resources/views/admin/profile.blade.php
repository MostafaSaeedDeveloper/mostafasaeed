@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-semibold">{{ __('messages.profile') }}</h1>
    <form class="mt-6 rounded bg-white p-6 shadow" method="POST" action="{{ route('admin.profile.update') }}">
        @csrf
        @method('PUT')
        <div class="grid gap-4 md:grid-cols-2">
            <div>
                <label class="text-sm">{{ __('messages.name') }}</label>
                <input class="mt-1 w-full rounded border px-3 py-2" name="name" value="{{ old('name', $profile?->name) }}">
            </div>
            <div>
                <label class="text-sm">{{ __('messages.profile_image') }}</label>
                <input class="mt-1 w-full rounded border px-3 py-2" name="profile_image" value="{{ old('profile_image', $profile?->profile_image) }}">
            </div>
            <div>
                <label class="text-sm">{{ __('messages.titles_en') }}</label>
                <input class="mt-1 w-full rounded border px-3 py-2" name="titles[en][]" value="{{ old('titles.en.0', $profile?->titles['en'][0] ?? '') }}">
            </div>
            <div>
                <label class="text-sm">{{ __('messages.titles_ar') }}</label>
                <input class="mt-1 w-full rounded border px-3 py-2" name="titles[ar][]" value="{{ old('titles.ar.0', $profile?->titles['ar'][0] ?? '') }}">
            </div>
            <div class="md:col-span-2">
                <label class="text-sm">{{ __('messages.bio_en') }}</label>
                <textarea class="mt-1 w-full rounded border px-3 py-2" name="bio[en]" rows="3">{{ old('bio.en', $profile?->bio['en'] ?? '') }}</textarea>
            </div>
            <div class="md:col-span-2">
                <label class="text-sm">{{ __('messages.bio_ar') }}</label>
                <textarea class="mt-1 w-full rounded border px-3 py-2" name="bio[ar]" rows="3">{{ old('bio.ar', $profile?->bio['ar'] ?? '') }}</textarea>
            </div>
        </div>
        <button class="mt-4 rounded bg-slate-900 px-4 py-2 text-white" type="submit">{{ __('messages.save') }}</button>
    </form>
@endsection
