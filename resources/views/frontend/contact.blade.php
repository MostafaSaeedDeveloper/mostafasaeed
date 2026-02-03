@extends('layouts.frontend')

@section('title', __('app.nav_contact'))

@section('content')
<section class="container">
    <h1 class="h3 mb-4">{{ __('app.contact_me') }}</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form method="POST" action="{{ route('contact.store') }}" class="row g-3">
        @csrf
        <div class="col-md-6">
            <label class="form-label">{{ __('app.name') }}</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">{{ __('app.email') }}</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">{{ __('app.service') }}</label>
            <select name="service" class="form-select">
                <option value="">{{ __('app.choose_service') }}</option>
                @foreach($services as $service)
                    <option value="{{ $service->getTranslated('title') }}">{{ $service->getTranslated('title') }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12">
            <label class="form-label">{{ __('app.message') }}</label>
            <textarea name="message" class="form-control" rows="5" required></textarea>
        </div>
        <div style="display:none;">
            <input type="text" name="website" tabindex="-1" autocomplete="off">
        </div>
        <div class="col-12">
            <button class="btn btn-primary" type="submit">{{ __('app.send_message') }}</button>
        </div>
    </form>
</section>
@endsection
