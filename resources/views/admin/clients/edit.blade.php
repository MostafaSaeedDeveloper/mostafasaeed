@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-semibold">{{ __('messages.edit_client') }}</h1>
    <form class="mt-6 rounded bg-white p-6 shadow" method="POST" action="{{ route('admin.clients.update', $client) }}">
        @csrf
        @method('PUT')
        @include('admin.clients.form', ['client' => $client])
    </form>
@endsection
