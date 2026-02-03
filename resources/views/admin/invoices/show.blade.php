@extends('layouts.admin')

@section('content')
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-semibold">{{ $invoice->number }}</h1>
        <a class="rounded bg-slate-900 px-3 py-2 text-white" href="{{ route('admin.invoices.pdf', $invoice) }}">{{ __('messages.download_pdf') }}</a>
    </div>
    <div class="mt-6 rounded bg-white p-6 shadow">
        <p>{{ __('messages.customer') }}: {{ $invoice->customer?->name }}</p>
        <p>{{ __('messages.status') }}: {{ $invoice->status }}</p>
        <p>{{ __('messages.total') }}: {{ number_format($invoice->total, 2) }}</p>
        <h2 class="mt-4 font-semibold">{{ __('messages.items') }}</h2>
        <ul class="mt-2 text-sm">
            @foreach($invoice->items as $item)
                <li>{{ $item->name }} - {{ $item->quantity }} x {{ $item->unit_price }}</li>
            @endforeach
        </ul>
    </div>
@endsection
