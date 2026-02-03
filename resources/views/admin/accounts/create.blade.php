@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-semibold">{{ __('messages.add_account') }}</h1>
    <form class="mt-6 rounded bg-white p-6 shadow" method="POST" action="{{ route('admin.accounts.store') }}">
        @csrf
        @include('admin.accounts.form', ['account' => null])
    </form>
@endsection
