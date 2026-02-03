@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-semibold">{{ __('messages.add_service') }}</h1>
    <form class="mt-6 rounded bg-white p-6 shadow" method="POST" action="{{ route('admin.services.store') }}">
        @csrf
        @include('admin.services.form', ['service' => null])
    </form>
@endsection
