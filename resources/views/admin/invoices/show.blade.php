@extends('layouts.admin')
@section('title', 'Invoice #'.$invoice->invoice_number)
@section('content')
<div class="card p-3 mb-3"><h5>#{{ $invoice->invoice_number }} - {{ $invoice->customer?->name }}</h5><div>{{ $invoice->status }} | {{ optional($invoice->issue_date)->format('Y-m-d') }}</div><div>Total: {{ number_format($invoice->total,2) }}</div></div>
<div class="card p-3 mb-3"><h6>Items</h6><ul>@foreach($invoice->items as $item)<li>{{ $item->name }} - {{ $item->qty }} x {{ $item->unit_price }} = {{ number_format($item->line_total,2) }}</li>@endforeach</ul></div>
<div class="card p-3"><h6>Payments</h6><ul>@forelse($invoice->payments as $payment)<li>{{ optional($payment->date)->format('Y-m-d') }} - {{ number_format($payment->amount,2) }}</li>@empty<li>-</li>@endforelse</ul></div>
@endsection
