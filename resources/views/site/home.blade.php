@extends('layouts.site')

@section('content')
    <div class="grid gap-10">
        <section class="rounded bg-white p-8 shadow">
            <h1 class="text-3xl font-semibold">{{ $profile?->name ?? 'Mostafa Saeed' }}</h1>
            <p class="mt-2 text-slate-600">{{ collect($profile?->titles[app()->getLocale()] ?? [])->join(' · ') }}</p>
            <div class="mt-4 text-slate-700">{!! $profile?->bio[app()->getLocale()] ?? '' !!}</div>
        </section>

        <section>
            <h2 class="text-2xl font-semibold">{{ __('messages.services') }}</h2>
            <div class="mt-4 grid gap-4 md:grid-cols-3">
                @foreach($services as $service)
                    <div class="rounded bg-white p-4 shadow">
                        <div class="text-sm text-slate-500">{{ $service->icon }}</div>
                        <h3 class="mt-2 font-semibold">{{ $service->title[app()->getLocale()] ?? '' }}</h3>
                        <p class="text-sm text-slate-600">{{ $service->short_description[app()->getLocale()] ?? '' }}</p>
                    </div>
                @endforeach
            </div>
        </section>

        <section>
            <h2 class="text-2xl font-semibold">{{ __('messages.projects') }}</h2>
            <div class="mt-4 grid gap-4 md:grid-cols-3">
                @foreach($projects as $project)
                    <a href="{{ route('projects.show', $project) }}" class="rounded bg-white p-4 shadow">
                        <h3 class="font-semibold">{{ $project->title[app()->getLocale()] ?? '' }}</h3>
                        <p class="text-sm text-slate-600">{{ $project->summary[app()->getLocale()] ?? '' }}</p>
                    </a>
                @endforeach
            </div>
        </section>

        <section>
            <h2 class="text-2xl font-semibold">{{ __('messages.clients') }}</h2>
            <div class="mt-4 grid gap-4 md:grid-cols-4">
                @foreach($clients as $client)
                    <div class="rounded bg-white p-4 text-center shadow">{{ $client->name }}</div>
                @endforeach
            </div>
        </section>
    </div>
@endsection
