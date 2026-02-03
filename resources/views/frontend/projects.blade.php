@extends('layouts.frontend')

@section('title', __('app.nav_projects'))

@section('content')
<section class="container">
    <h1 class="h3 mb-4">{{ __('app.projects') }}</h1>
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
                        <a href="{{ route('projects.show', $project->slug) }}" class="btn btn-outline-primary btn-sm">{{ __('app.view_details') }}</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
@endsection
