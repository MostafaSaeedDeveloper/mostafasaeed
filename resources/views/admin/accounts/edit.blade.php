@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-semibold">{{ __('messages.edit_account') }}</h1>
    <form class="mt-6 rounded bg-white p-6 shadow" method="POST" action="{{ route('admin.accounts.update', $account) }}">
        @csrf
        @method('PUT')
        @include('admin.accounts.form', ['account' => $account])
    </form>
@endsection
