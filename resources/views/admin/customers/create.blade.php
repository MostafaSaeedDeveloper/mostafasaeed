@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-semibold">{{ __('messages.add_customer') }}</h1>
    <form class="mt-6 rounded bg-white p-6 shadow" method="POST" action="{{ route('admin.customers.store') }}">
        @csrf
        @include('admin.customers.form', ['customer' => null])
    </form>
@endsection
