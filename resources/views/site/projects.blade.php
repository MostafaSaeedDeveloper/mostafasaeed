@extends('layouts.site')

@section('content')
    <h1 class="text-3xl font-semibold">{{ __('messages.projects') }}</h1>
    <div class="mt-6 grid gap-4 md:grid-cols-3">
        @foreach($projects as $project)
            <a href="{{ route('projects.show', $project) }}" class="rounded bg-white p-6 shadow">
                <h2 class="font-semibold">{{ $project->title[app()->getLocale()] ?? '' }}</h2>
                <p class="mt-2 text-sm text-slate-600">{{ $project->summary[app()->getLocale()] ?? '' }}</p>
            </a>
        @endforeach
    </div>
@endsection
