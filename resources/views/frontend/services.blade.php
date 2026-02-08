@extends('layouts.frontend')

@section('title', __('app.nav_services'))

@section('content')
<section class="container">
    <h1 class="section-title">Services</h1>
    <p class="section-subtitle">Professional solutions with clean implementation and long-term reliability.</p>
    <div class="row g-3">
        @foreach($services as $service)
            <div class="col-md-6 col-lg-4">
                <div class="premium-card">
                    <h2 class="h5">{{ $service['title'] }}</h2>
                    <p class="text-secondary mb-0">{{ $service['description'] }}</p>
                </div>
            </div>
        @endforeach
    </div>
</section>
@endsection
