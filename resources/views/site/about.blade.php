@extends('layouts.site')

@section('content')
    <section class="rounded bg-white p-8 shadow">
        <h1 class="text-3xl font-semibold">{{ __('messages.about') }}</h1>
        <div class="mt-4 text-slate-700">{!! $profile?->bio[app()->getLocale()] ?? '' !!}</div>
        <div class="mt-4 text-sm text-slate-500">{{ collect($profile?->skills ?? [])->join(' · ') }}</div>
    </section>
@endsection
