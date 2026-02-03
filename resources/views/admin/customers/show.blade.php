@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-semibold">{{ $customer->name }}</h1>
    <div class="mt-6 grid gap-6 md:grid-cols-2">
        <div class="rounded bg-white p-6 shadow">
            <h2 class="text-lg font-semibold">{{ __('messages.overview') }}</h2>
            <p class="mt-2 text-sm text-slate-600">{{ __('messages.status') }}: {{ $customer->status }}</p>
            <p class="text-sm text-slate-600">{{ __('messages.email') }}: {{ $customer->email }}</p>
        </div>
        <div class="rounded bg-white p-6 shadow">
            <h2 class="text-lg font-semibold">{{ __('messages.invoices') }}</h2>
            <ul class="mt-2 text-sm">
                @foreach($customer->invoices as $invoice)
                    <li>{{ $invoice->number }} - {{ $invoice->status }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
