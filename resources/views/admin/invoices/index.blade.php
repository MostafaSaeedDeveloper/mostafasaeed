@extends('layouts.admin')
@section('title', __('app.invoices'))
@section('page_title', 'Invoices')
@section('breadcrumb')
<ol class="breadcrumb float-sm-right"><li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li><li class="breadcrumb-item active">Invoices</li></ol>
@endsection
@section('content')
<div class="card">
<div class="card-header">
<form method="GET" class="row g-2 align-items-end">
<div class="col-md-3"><label>Search</label><input name="q" class="form-control" value="{{ request('q') }}" placeholder="Invoice #"></div>
<div class="col-md-3"><label>Status</label><select name="status" class="form-control"><option value="">All</option>@foreach(['draft','sent','paid','partially_paid','overdue','cancelled'] as $s)<option value="{{ $s }}" @selected(request('status')===$s)>{{ ucfirst(str_replace('_',' ',$s)) }}</option>@endforeach</select></div>
<div class="col-md-4 d-flex gap-2"><button class="btn btn-outline-secondary">Filter</button><a href="{{ route('admin.invoices.create') }}" class="btn btn-primary">Add Invoice</a></div>
</form>
</div>
<div class="card-body table-responsive"><table class="table table-hover datatable"><thead><tr><th>#</th><th>Customer</th><th>Total</th><th>Paid</th><th>Due</th><th>Status</th><th>Due Date</th><th>Actions</th></tr></thead><tbody>
@foreach($invoices as $invoice)<tr><td><a href="{{ route('admin.invoices.show',$invoice) }}">{{ $invoice->invoice_prefix ?? 'INV-' }}{{ str_pad($invoice->invoice_number,6,'0',STR_PAD_LEFT) }}</a></td><td>{{ $invoice->customer?->name }}</td><td>{{ number_format($invoice->total,2) }}</td><td>{{ number_format($invoice->paid_amount ?? 0,2) }}</td><td>{{ number_format($invoice->due_amount ?? $invoice->total,2) }}</td><td><span class="badge badge-{{ in_array($invoice->status,['paid']) ? 'success' : (in_array($invoice->status,['overdue','cancelled']) ? 'danger':'warning') }}">{{ ucfirst(str_replace('_',' ',$invoice->status)) }}</span></td><td>{{ optional($invoice->due_date)->format('Y-m-d') }}</td><td class="d-flex gap-1"><a class="btn btn-sm btn-outline-primary" href="{{ route('admin.invoices.edit',$invoice) }}">Edit</a><a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.invoices.pdf',$invoice) }}">PDF</a></td></tr>@endforeach
</tbody></table></div>
</div>
@endsection
