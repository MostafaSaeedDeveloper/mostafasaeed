@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-semibold">{{ __('messages.edit_expense') }}</h1>
    <form class="mt-6 rounded bg-white p-6 shadow" method="POST" action="{{ route('admin.expenses.update', $expense) }}">
        @csrf
        @method('PUT')
        @include('admin.expenses.form', ['expense' => $expense])
    </form>
@endsection
