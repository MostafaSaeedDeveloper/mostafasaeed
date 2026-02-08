@extends('layouts.frontend')

@section('title', __('app.nav_projects'))

@section('content')
<section class="container">
    <h1 class="section-title">Projects Portfolio</h1>
    <p class="section-subtitle">Modern grid with filters by service type, all managed from the admin panel.</p>

    <div class="d-flex flex-wrap gap-2 mb-4">
        <a href="{{ route('projects') }}" class="btn btn-sm filter-chip {{ request('service_type') ? '' : 'active' }}">All</a>
        @foreach($serviceTypes as $serviceType)
            <a href="{{ route('projects', ['service_type' => $serviceType]) }}" class="btn btn-sm filter-chip {{ request('service_type') === $serviceType ? 'active' : '' }}">{{ $serviceType }}</a>
        @endforeach
    </div>

    <div class="row g-3">
        @forelse($projects as $project)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100">
                    @if($project->main_image_path)
                        <img src="{{ asset($project->main_image_path) }}" class="card-img-top" alt="{{ $project->getTranslated('title') }}">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <p class="small text-secondary mb-1">{{ $project->category ?: 'General' }}</p>
                        <h2 class="h5 card-title">{{ $project->getTranslated('title') }}</h2>
                        <p class="card-text text-secondary flex-grow-1">{{ $project->getTranslated('summary') }}</p>
                        <a href="{{ route('projects.show', $project->slug) }}" class="btn btn-outline-primary btn-sm">{{ __('app.view_details') }}</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-secondary">No projects found for this filter.</p>
        @endforelse
    </div>
</section>
@endsection
