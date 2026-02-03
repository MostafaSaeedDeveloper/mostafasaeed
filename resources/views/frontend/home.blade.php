@extends('layouts.frontend')

@section('title', __('app.nav_home'))

@section('content')
<section class="container mb-5">
    <div class="row align-items-center">
        <div class="col-lg-6">
            <h1 class="display-5 fw-bold">{{ $profile?->name ?? 'Mostafa Saeed' }}</h1>
            <p class="lead text-muted">{{ $profile?->getTranslated('titles') ?? __('app.default_titles') }}</p>
            <div class="d-flex gap-2">
                <a class="btn btn-primary" href="{{ route('projects') }}">{{ __('app.view_projects') }}</a>
                <a class="btn btn-outline-secondary" href="{{ route('contact') }}">{{ __('app.contact_me') }}</a>
            </div>
        </div>
        <div class="col-lg-6 text-center">
            @if($profile?->profile_image_path)
                <img src="{{ asset($profile->profile_image_path) }}" class="img-fluid rounded shadow-sm" alt="Profile">
            @else
                <div class="bg-light border rounded p-5">{{ __('app.profile_placeholder') }}</div>
            @endif
        </div>
    </div>
</section>

<section class="container mb-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="h4">{{ __('app.services') }}</h2>
        <a href="{{ route('services') }}" class="text-decoration-none">{{ __('app.view_all') }}</a>
    </div>
    <div class="row g-3">
        @foreach($services as $service)
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $service->getTranslated('title') }}</h5>
                        <p class="card-text text-muted">{{ $service->getTranslated('short_description') }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>

<section class="container mb-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="h4">{{ __('app.featured_projects') }}</h2>
        <a href="{{ route('projects') }}" class="text-decoration-none">{{ __('app.view_all') }}</a>
    </div>
    <div class="row g-3">
        @foreach($projects as $project)
            <div class="col-md-4">
                <div class="card h-100">
                    @if($project->main_image_path)
                        <img src="{{ asset($project->main_image_path) }}" class="card-img-top" alt="{{ $project->getTranslated('title') }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $project->getTranslated('title') }}</h5>
                        <p class="card-text text-muted">{{ $project->getTranslated('summary') }}</p>
                        <a href="{{ route('projects.show', $project->slug) }}" class="btn btn-sm btn-outline-primary">{{ __('app.read_more') }}</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>

<section class="container mb-5">
    <h2 class="h4 mb-3">{{ __('app.clients') }}</h2>
    <div class="row g-3">
        @foreach($clients as $client)
            <div class="col-6 col-md-3">
                <div class="border rounded p-3 text-center bg-white">
                    @if($client->logo_path)
                        <img src="{{ asset($client->logo_path) }}" alt="{{ $client->name }}" class="img-fluid" style="max-height: 60px;">
                    @else
                        <span>{{ $client->name }}</span>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</section>

<section class="container">
    <div class="bg-primary text-white p-4 rounded">
        <div class="d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">
            <div>
                <h2 class="h4 mb-1">{{ __('app.contact_cta_title') }}</h2>
                <p class="mb-0">{{ __('app.contact_cta_text') }}</p>
            </div>
            <a href="{{ route('contact') }}" class="btn btn-light">{{ __('app.contact_me') }}</a>
        </div>
    </div>
</section>
@endsection
