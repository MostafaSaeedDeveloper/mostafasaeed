@extends('layouts.frontend')

@section('title', __('app.nav_services'))

@section('content')
<section class="container">
    <h1 class="h3 mb-4">{{ __('app.services') }}</h1>
    <div class="row g-3">
        @foreach($services as $service)
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $service->getTranslated('title') }}</h5>
                        <p class="card-text text-muted">{{ $service->getTranslated('description') }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
@endsection
