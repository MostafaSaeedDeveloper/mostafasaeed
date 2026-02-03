@extends('layouts.frontend')

@section('title', $project->getTranslated('title'))
@section('meta_description', $project->seo_meta['description'][app()->getLocale()] ?? $project->getTranslated('summary'))

@push('meta')
    <meta property="og:title" content="{{ $project->getTranslated('title') }}">
    <meta property="og:description" content="{{ $project->seo_meta['description'][app()->getLocale()] ?? $project->getTranslated('summary') }}">
    @if($project->main_image_path)
        <meta property="og:image" content="{{ asset($project->main_image_path) }}">
    @endif
@endpush

@section('content')
<section class="container">
    <div class="mb-4">
        <h1 class="h3">{{ $project->getTranslated('title') }}</h1>
        <p class="text-muted">{{ $project->getTranslated('summary') }}</p>
    </div>

    @if($project->main_image_path)
        <img src="{{ asset($project->main_image_path) }}" class="img-fluid rounded mb-4" alt="{{ $project->getTranslated('title') }}">
    @endif

    <div class="row g-4">
        <div class="col-lg-8">
            <h5>{{ __('app.case_study') }}</h5>
            <p class="text-muted">{{ $project->getTranslated('case_study') }}</p>

            @if($project->images->count())
                <div class="row g-2 mt-3">
                    @foreach($project->images as $image)
                        <div class="col-md-4">
                            <img src="{{ asset($image->path) }}" class="img-fluid rounded" alt="Gallery">
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h6>{{ __('app.tech_stack') }}</h6>
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        @foreach(($project->tech_stack ?? []) as $tech)
                            <span class="badge bg-secondary">{{ $tech }}</span>
                        @endforeach
                    </div>
                    @if($project->live_url)
                        <a href="{{ $project->live_url }}" class="btn btn-primary w-100 mb-2" target="_blank">{{ __('app.live_demo') }}</a>
                    @endif
                    @if($project->repo_url)
                        <a href="{{ $project->repo_url }}" class="btn btn-outline-secondary w-100" target="_blank">{{ __('app.view_repo') }}</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
