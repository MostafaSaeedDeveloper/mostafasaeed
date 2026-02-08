@extends('layouts.admin')
@section('title', 'Invoice #'.$invoice->invoice_number)
@section('page_title', 'Invoice Details')
@section('breadcrumb')
<ol class="breadcrumb float-sm-right"><li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li><li class="breadcrumb-item"><a href="{{ route('admin.invoices.index') }}">Invoices</a></li><li class="breadcrumb-item active">#{{ $invoice->invoice_number }}</li></ol>
@endsection
@section('content')
<div class="mb-3 d-flex flex-wrap gap-2">
    <a href="{{ route('admin.invoices.pdf',$invoice) }}" class="btn btn-primary">Download PDF</a>
    <button onclick="window.print()" class="btn btn-outline-secondary">Print</button>
    <form method="POST" action="{{ route('admin.invoices.mark-sent',$invoice) }}">@csrf<button class="btn btn-outline-info">Mark as Sent</button></form>
    <a href="{{ route('admin.payments.create',['invoice_id'=>$invoice->id]) }}" class="btn btn-outline-success">Add Payment</a>
    <form method="POST" action="{{ route('admin.invoices.duplicate',$invoice) }}">@csrf<button class="btn btn-outline-dark">Duplicate</button></form>
</div>
<div class="card"><div class="card-body">
    <div class="row mb-4">
        <div class="col-md-6"><h4>{{ $settings?->brand_name ?? 'Mostafa CMS' }}</h4><p>{{ $settings?->contact_email }}<br>{{ $settings?->contact_phone }}</p></div>
        <div class="col-md-6 text-md-right"><h5>{{ $invoice->invoice_prefix ?? 'INV-' }}{{ str_pad($invoice->invoice_number,6,'0',STR_PAD_LEFT) }}</h5><p>Issue: {{ optional($invoice->issue_date)->format('Y-m-d') }}<br>Due: {{ optional($invoice->due_date)->format('Y-m-d') }}</p></div>
    </div>
    <h6>Bill To: {{ $invoice->customer?->name }}</h6>
    <div class="table-responsive"><table class="table table-bordered"><thead><tr><th>Item</th><th>Qty</th><th>Price</th><th>Discount</th><th>Total</th></tr></thead><tbody>@foreach($invoice->items as $item)<tr><td>{{ $item->name }}</td><td>{{ $item->qty }}</td><td>{{ number_format($item->unit_price,2) }}</td><td>{{ number_format($item->line_discount,2) }}</td><td>{{ number_format($item->line_total,2) }}</td></tr>@endforeach</tbody></table></div>
    <div class="row justify-content-end"><div class="col-md-4"><table class="table table-sm"><tr><th>Subtotal</th><td>{{ number_format($invoice->subtotal,2) }}</td></tr><tr><th>Discount</th><td>{{ number_format($invoice->discount,2) }}</td></tr><tr><th>Tax</th><td>{{ number_format($invoice->tax,2) }}</td></tr><tr><th>Grand Total</th><td>{{ number_format($invoice->total,2) }}</td></tr><tr><th>Paid</th><td>{{ number_format($invoice->paid_amount ?? 0,2) }}</td></tr><tr><th>Due</th><td>{{ number_format($invoice->due_amount ?? $invoice->total,2) }}</td></tr></table></div></div>
    <p><strong>Notes:</strong> {{ $invoice->notes ?: '-' }}</p>
    <p><strong>Terms:</strong> {{ $settings?->invoice_terms ?: '-' }}</p>
</div></div>
@endsection
