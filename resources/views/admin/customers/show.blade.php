@extends('layouts.admin')
@section('title', $customer->name)
@section('content')
<div class="row g-3 mb-3">
<div class="col-md-4"><div class="card p-3"><small>Total Invoiced</small><h4>{{ number_format($totalInvoiced,2) }}</h4></div></div>
<div class="col-md-4"><div class="card p-3"><small>Total Paid</small><h4>{{ number_format($totalPaid,2) }}</h4></div></div>
<div class="col-md-4"><div class="card p-3"><small>Remaining</small><h4>{{ number_format($totalInvoiced-$totalPaid,2) }}</h4></div></div>
</div>
<div class="card mb-3"><div class="card-header">Projects</div><ul class="list-group list-group-flush">@forelse($customer->projects as $project)<li class="list-group-item">{{ data_get($project->title,app()->getLocale()) }}</li>@empty<li class="list-group-item text-muted">-</li>@endforelse</ul></div>
<div class="card mb-3"><div class="card-header">Invoices</div><ul class="list-group list-group-flush">@forelse($customer->invoices as $invoice)<li class="list-group-item">#{{ $invoice->invoice_number }} - {{ number_format($invoice->total,2) }} ({{ $invoice->status }})</li>@empty<li class="list-group-item text-muted">-</li>@endforelse</ul></div>
<div class="card"><div class="card-header">Payments</div><ul class="list-group list-group-flush">@forelse($customer->payments as $payment)<li class="list-group-item">{{ optional($payment->date)->format('Y-m-d') }} - {{ number_format($payment->amount,2) }} ({{ $payment->payment_method }})</li>@empty<li class="list-group-item text-muted">-</li>@endforelse</ul></div>
@endsection
