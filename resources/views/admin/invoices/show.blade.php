@extends('layouts.admin')
@section('title', $invoice->invoice_number)
@section('page_title', 'Invoice Details')
@section('content')
<div class="d-flex flex-wrap gap-2 mb-3">
    <a href="{{ route('admin.invoices.pdf', $invoice) }}" class="btn btn-primary">Download PDF</a>
    <button type="button" onclick="window.print()" class="btn btn-outline-secondary">Print</button>
    <form method="POST" action="{{ route('admin.invoices.mark-sent', $invoice) }}">@csrf<button class="btn btn-outline-info">Mark as Sent</button></form>
    <form method="POST" action="{{ route('admin.invoices.mark-paid', $invoice) }}">@csrf<button class="btn btn-outline-success">Mark as Paid</button></form>
    <form method="POST" action="{{ route('admin.invoices.mark-overdue', $invoice) }}">@csrf<button class="btn btn-outline-danger">Mark as Overdue</button></form>
</div>
<div class="card"><div class="card-body">
    <div class="row mb-4"><div class="col-md-6"><h3>{{ $settings?->brand_name ?? 'Mostafa Saeed' }}</h3><p class="mb-0">{{ $settings?->contact_email }}<br>{{ $settings?->contact_phone }}</p></div><div class="col-md-6 text-md-end"><h4>{{ $invoice->invoice_number }}</h4><p class="mb-0">Issue: {{ $invoice->issue_date?->format('Y-m-d') }}<br>Due: {{ $invoice->due_date?->format('Y-m-d') }}</p></div></div>
    <p><strong>Bill To:</strong> {{ $invoice->client?->name }}</p>
    <div class="table-responsive"><table class="table table-bordered"><thead><tr><th>Description</th><th>Qty</th><th>Unit Price</th><th>Total</th></tr></thead><tbody>@foreach($invoice->items as $item)<tr><td>{{ $item->description }}</td><td>{{ $item->quantity }}</td><td>{{ number_format($item->unit_price,2) }}</td><td>{{ number_format($item->total,2) }}</td></tr>@endforeach</tbody></table></div>
    <div class="row justify-content-end"><div class="col-md-4"><table class="table"><tr><th>Subtotal</th><td>{{ number_format($invoice->subtotal,2) }}</td></tr><tr><th>Tax</th><td>{{ number_format($invoice->tax_amount,2) }}</td></tr><tr><th>Total</th><td>{{ number_format($invoice->total,2) }}</td></tr><tr><th>Paid</th><td>{{ number_format($invoice->paid_amount,2) }}</td></tr><tr><th>Due</th><td>{{ number_format($invoice->due_amount,2) }}</td></tr></table></div></div>
</div></div>
@endsection
