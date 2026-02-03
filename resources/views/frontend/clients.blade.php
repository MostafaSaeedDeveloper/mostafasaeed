@extends('layouts.frontend')

@section('title', __('app.nav_clients'))

@section('content')
<section class="container">
    <h1 class="h3 mb-4">{{ __('app.clients') }}</h1>
    <div class="row g-3">
        @foreach($clients as $client)
            <div class="col-6 col-md-3">
                <div class="border rounded p-3 text-center bg-white h-100">
                    @if($client->logo_path)
                        <img src="{{ asset($client->logo_path) }}" alt="{{ $client->name }}" class="img-fluid" style="max-height: 80px;">
                    @else
                        <span>{{ $client->name }}</span>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</section>
@endsection
