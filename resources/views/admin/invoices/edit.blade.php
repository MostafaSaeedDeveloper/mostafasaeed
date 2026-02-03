@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-semibold">{{ __('messages.edit_invoice') }}</h1>
    <form class="mt-6 rounded bg-white p-6 shadow" method="POST" action="{{ route('admin.invoices.update', $invoice) }}">
        @csrf
        @method('PUT')
        @include('admin.invoices.form', ['invoice' => $invoice])
    </form>
@endsection
