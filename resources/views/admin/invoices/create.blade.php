@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-semibold">{{ __('messages.add_invoice') }}</h1>
    <p class="text-sm text-slate-500">{{ __('messages.next_number') }}: {{ $nextNumber }}</p>
    <form class="mt-6 rounded bg-white p-6 shadow" method="POST" action="{{ route('admin.invoices.store') }}">
        @csrf
        @include('admin.invoices.form', ['invoice' => null])
    </form>
@endsection
