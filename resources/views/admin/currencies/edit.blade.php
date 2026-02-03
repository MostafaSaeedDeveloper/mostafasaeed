@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-semibold">{{ __('messages.edit_currency') }}</h1>
    <form class="mt-6 rounded bg-white p-6 shadow" method="POST" action="{{ route('admin.currencies.update', $currency) }}">
        @csrf
        @method('PUT')
        @include('admin.currencies.form', ['currency' => $currency])
    </form>
@endsection
