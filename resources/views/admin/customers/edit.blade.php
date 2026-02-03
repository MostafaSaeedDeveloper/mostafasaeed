@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-semibold">{{ __('messages.edit_customer') }}</h1>
    <form class="mt-6 rounded bg-white p-6 shadow" method="POST" action="{{ route('admin.customers.update', $customer) }}">
        @csrf
        @method('PUT')
        @include('admin.customers.form', ['customer' => $customer])
    </form>
@endsection
