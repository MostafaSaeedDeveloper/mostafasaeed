@extends('layouts.site')

@section('content')
    <article class="rounded bg-white p-8 shadow">
        <h1 class="text-3xl font-semibold">{{ $project->title[app()->getLocale()] ?? '' }}</h1>
        <p class="mt-2 text-slate-600">{{ $project->summary[app()->getLocale()] ?? '' }}</p>
        <div class="mt-4 text-slate-700">{!! $project->case_study[app()->getLocale()] ?? '' !!}</div>
        @if($project->client)
            <p class="mt-4 text-sm text-slate-500">{{ __('messages.client') }}: {{ $project->client->name }}</p>
        @endif
        @if($project->live_url)
            <a class="mt-4 inline-block text-indigo-600" href="{{ $project->live_url }}" target="_blank" rel="noopener">{{ __('messages.live_site') }}</a>
        @endif
    </article>
@endsection
