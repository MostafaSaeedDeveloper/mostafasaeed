@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-semibold">{{ __('messages.contact_message') }}</h1>
    <div class="mt-6 rounded bg-white p-6 shadow">
        <p><strong>{{ __('messages.name') }}:</strong> {{ $message->name }}</p>
        <p><strong>{{ __('messages.email') }}:</strong> {{ $message->email }}</p>
        <p><strong>{{ __('messages.service') }}:</strong> {{ $message->service }}</p>
        <p class="mt-4">{{ $message->message }}</p>
    </div>
@endsection
