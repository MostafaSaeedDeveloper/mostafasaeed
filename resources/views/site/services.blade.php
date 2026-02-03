@extends('layouts.site')

@section('content')
    <h1 class="text-3xl font-semibold">{{ __('messages.services') }}</h1>
    <div class="mt-6 grid gap-4 md:grid-cols-3">
        @foreach($services as $service)
            <div class="rounded bg-white p-6 shadow">
                <h2 class="font-semibold">{{ $service->title[app()->getLocale()] ?? '' }}</h2>
                <p class="mt-2 text-sm text-slate-600">{{ $service->description[app()->getLocale()] ?? '' }}</p>
            </div>
        @endforeach
    </div>
@endsection
