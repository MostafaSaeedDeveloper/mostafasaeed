@extends('layouts.admin')

@section('title', __('app.message_details'))

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">{{ $message->name }}</h5>
        <p class="card-text"><strong>{{ __('app.email') }}:</strong> {{ $message->email }}</p>
        <p class="card-text"><strong>{{ __('app.service') }}:</strong> {{ $message->service }}</p>
        <p class="card-text"><strong>{{ __('app.message') }}:</strong> {{ $message->message }}</p>
    </div>
</div>
@endsection
