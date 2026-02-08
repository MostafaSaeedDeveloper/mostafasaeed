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
        <p class="small text-secondary mb-1">{{ $project->category ?: 'General' }}</p>
        <h1 class="h3">{{ $project->getTranslated('title') }}</h1>
        <p class="text-secondary">{{ $project->getTranslated('summary') }}</p>
    </div>

    @if($project->main_image_path)
        <img src="{{ asset($project->main_image_path) }}" class="img-fluid rounded mb-4" alt="{{ $project->getTranslated('title') }}">
    @endif

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="premium-card">
                <h5>Full Description</h5>
                <p class="text-secondary mb-0">{{ $project->getTranslated('case_study') }}</p>
            </div>

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
            <div class="premium-card">
                <h6 class="mb-2">Service Type</h6>
                <p class="text-secondary">{{ $project->category ?: 'General' }}</p>
                <h6>{{ __('app.tech_stack') }}</h6>
                <div class="d-flex flex-wrap gap-2 mb-3">
                    @foreach(($project->tech_stack ?? []) as $tech)
                        <span class="badge">{{ $tech }}</span>
                    @endforeach
                </div>
                @if($project->live_url)
                    <a href="{{ $project->live_url }}" class="btn btn-primary w-100 mb-2" target="_blank">Project URL</a>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
