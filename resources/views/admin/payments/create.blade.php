@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-semibold">{{ __('messages.add_payment') }}</h1>
    <form class="mt-6 rounded bg-white p-6 shadow" method="POST" action="{{ route('admin.payments.store') }}">
        @csrf
        @include('admin.payments.form', ['payment' => null])
    </form>
@endsection
