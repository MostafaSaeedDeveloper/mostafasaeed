@extends('layouts.admin')
@section('title', __('app.payments'))
@section('page_title', 'Payments')
@section('breadcrumb')
<ol class="breadcrumb float-sm-right"><li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li><li class="breadcrumb-item active">Payments</li></ol>
@endsection
@section('content')
<div class="card">
<div class="card-header">
<form method="GET" class="row g-2 align-items-end">
<div class="col-md-3"><label>Client</label><select name="customer_id" class="form-control"><option value="">All</option>@foreach($customers as $c)<option value="{{ $c->id }}" @selected(request('customer_id')==$c->id)>{{ $c->name }}</option>@endforeach</select></div>
<div class="col-md-3"><label>Method</label><select name="payment_method_id" class="form-control"><option value="">All</option>@foreach($methods as $m)<option value="{{ $m->id }}" @selected(request('payment_method_id')==$m->id)>{{ $m->name }}</option>@endforeach</select></div>
<div class="col-md-2"><label>From</label><input type="date" name="from" value="{{ request('from') }}" class="form-control"></div>
<div class="col-md-2"><label>To</label><input type="date" name="to" value="{{ request('to') }}" class="form-control"></div>
<div class="col-md-2 d-flex gap-2"><button class="btn btn-outline-secondary">Filter</button><a href="{{ route('admin.payments.create') }}" class="btn btn-primary">+ Payment</a></div>
</form>
</div>
<div class="card-body table-responsive"><table class="table table-striped datatable"><thead><tr><th>Customer</th><th>Invoice</th><th>Amount</th><th>Method</th><th>Date</th><th>Actions</th></tr></thead><tbody>@foreach($payments as $payment)<tr><td>{{ $payment->customer?->name }}</td><td>{{ $payment->invoice?->invoice_number ? '#'.$payment->invoice->invoice_number : '-' }}</td><td>{{ number_format($payment->amount,2) }}</td><td>{{ $payment->paymentMethod?->name ?? '-' }}</td><td>{{ optional($payment->date)->format('Y-m-d') }}</td><td class="d-flex gap-2"><a class="btn btn-sm btn-outline-primary" href="{{ route('admin.payments.edit',$payment) }}">{{ __('app.edit') }}</a><form method="POST" action="{{ route('admin.payments.destroy',$payment) }}">@csrf @method('DELETE')<button data-confirm="{{ __('app.confirm_delete') }}" class="btn btn-sm btn-outline-danger">{{ __('app.delete') }}</button></form></td></tr>@endforeach</tbody></table></div>
</div>
@endsection
