@extends('layouts.frontend')

@section('title', 'Mostafa Saeed | Full Stack Web Developer')

@section('content')
<section class="container mb-5">
    <div class="row align-items-center g-4">
        <div class="col-lg-7">
            <p class="text-uppercase small text-secondary mb-2">Mostafa Saeed</p>
            <h1 class="display-5 fw-bold mb-3">Full Stack Web Developer</h1>
            <h2 class="h4 text-secondary mb-4">Laravel & WordPress Specialist<br>SEO & Digital Marketing</h2>
            <p class="lead text-secondary mb-4">I build scalable web applications, custom systems, and digital solutions that help businesses grow efficiently.</p>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('projects') }}" class="btn btn-primary px-4">View Portfolio</a>
                <a href="{{ route('contact') }}" class="btn btn-outline-primary px-4">Contact Me</a>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="premium-card">
                <h3 class="h5">Professional Focus</h3>
                <p class="text-secondary mb-0">Laravel, WordPress, frontend and backend engineering, SEO optimization, social media management, media buying, and long-term technical support for business growth.</p>
            </div>
        </div>
    </div>
</section>

<section class="container mb-5">
    <h2 class="section-title">About</h2>
    <p class="section-subtitle">Practical development and growth-focused digital execution.</p>
    <div class="premium-card">
        <p class="mb-0 text-secondary">I am a full stack web developer with strong hands-on experience in Laravel, WordPress, and complete frontend/backend implementation. I build custom systems and scalable digital solutions that improve workflows, strengthen business performance, and support long-term growth. My work also covers SEO optimization, social media management, and media buying to connect technical delivery with measurable marketing impact, backed by reliable maintenance and continuous support.</p>
    </div>
</section>

<section class="container mb-5">
    <h2 class="section-title">Experience</h2>
    <p class="section-subtitle">Professional journey across web development and digital delivery.</p>
    <div class="row g-3">
        @foreach($experiences as $experience)
            <div class="col-md-6">
                <div class="premium-card">
                    <h3 class="h5 mb-1">{{ $experience['title'] }}</h3>
                    <p class="mb-1">{{ $experience['company'] }}</p>
                    <p class="small text-secondary mb-2">{{ $experience['period'] }}</p>
                    <p class="text-secondary mb-0">{{ $experience['description'] }}</p>
                </div>
            </div>
        @endforeach
    </div>
</section>

<section class="container mb-5">
    <h2 class="section-title">Services</h2>
    <p class="section-subtitle">Clear solutions tailored for businesses that need reliable technical execution.</p>
    <div class="row g-3">
        @foreach($services as $service)
            <div class="col-md-6 col-lg-4">
                <div class="premium-card">
                    <h3 class="h5">{{ $service['title'] }}</h3>
                    <p class="text-secondary mb-0">{{ $service['description'] }}</p>
                </div>
            </div>
        @endforeach
    </div>
</section>

<section class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h2 class="section-title mb-1">Projects</h2>
            <p class="section-subtitle mb-0">Dynamic portfolio managed from the admin panel.</p>
        </div>
        <a href="{{ route('projects') }}" class="btn btn-outline-primary btn-sm">View All</a>
    </div>
    <div class="row g-3">
        @forelse($projects as $project)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100">
                    @if($project->main_image_path)
                        <img src="{{ asset($project->main_image_path) }}" class="card-img-top" alt="{{ $project->getTranslated('title') }}">
                    @endif
                    <div class="card-body">
                        <h3 class="h6">{{ $project->getTranslated('title') }}</h3>
                        <p class="text-secondary small">{{ $project->getTranslated('summary') }}</p>
                        <a href="{{ route('projects.show', $project->slug) }}" class="btn btn-outline-primary btn-sm">Details</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-secondary">No published projects yet.</p>
        @endforelse
    </div>
</section>
@endsection
