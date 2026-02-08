@extends('layouts.frontend')

@section('title', __('app.nav_about'))

@section('content')
<section class="container">
    <div class="row g-4">
        <div class="col-lg-4">
            @if($profile?->profile_image_path)
                <img src="{{ asset($profile->profile_image_path) }}" class="img-fluid rounded" alt="Profile">
            @else
                <div class="premium-card">Mostafa Saeed</div>
            @endif
        </div>
        <div class="col-lg-8">
            <h1 class="section-title">About Me</h1>
            <p class="text-secondary">I deliver practical and scalable digital solutions backed by strong hands-on experience in Laravel, WordPress, and end-to-end frontend/backend development. My work is centered on building custom systems, improving performance, and supporting business growth through technical excellence.</p>
            <p class="text-secondary">I also provide SEO optimization, social media management, and media buying support to align product development with marketing outcomes. My approach prioritizes clean execution, realistic planning, and long-term technical support to keep platforms stable and ready for scale.</p>
            <h5 class="mt-4">Core Expertise</h5>
            <div class="d-flex flex-wrap gap-2">
                @foreach(['Laravel', 'WordPress', 'Frontend Development', 'Backend Development', 'SEO Optimization', 'Social Media Management', 'Media Buying', 'Custom Systems'] as $skill)
                    <span class="badge">{{ $skill }}</span>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection
