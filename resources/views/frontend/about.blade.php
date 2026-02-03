@extends('layouts.frontend')

@section('title', __('app.nav_about'))

@section('content')
<section class="container">
    <div class="row g-4">
        <div class="col-lg-4">
            @if($profile?->profile_image_path)
                <img src="{{ asset($profile->profile_image_path) }}" class="img-fluid rounded" alt="Profile">
            @else
                <div class="bg-light border rounded p-5">{{ __('app.profile_placeholder') }}</div>
            @endif
        </div>
        <div class="col-lg-8">
            <h1 class="h3">{{ __('app.about_me') }}</h1>
            <p class="text-muted">{{ $profile?->getTranslated('bio') }}</p>
            <h5 class="mt-4">{{ __('app.skills') }}</h5>
            <div class="d-flex flex-wrap gap-2">
                @foreach(($profile?->skills ?? []) as $skill)
                    <span class="badge bg-secondary">{{ $skill }}</span>
                @endforeach
            </div>
            @if($profile?->cv_path)
                <div class="mt-4">
                    <a href="{{ asset($profile->cv_path) }}" class="btn btn-outline-primary" target="_blank">{{ __('app.download_cv') }}</a>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection
