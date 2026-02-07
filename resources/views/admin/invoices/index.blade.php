@extends('layouts.admin')
@section('title', __('app.invoices'))
@section('content')
<div class="d-flex justify-content-between mb-3">
<form method="GET" class="row g-2">
<div class="col-auto"><input name="q" class="form-control" value="{{ request('q') }}" placeholder="#"></div>
<div class="col-auto"><select name="status" class="form-select"><option value="">{{ __('app.status') }}</option>@foreach(['draft','sent','paid','partially_paid','overdue','cancelled'] as $s)<option value="{{ $s }}" @selected(request('status')===$s)>{{ $s }}</option>@endforeach</select></div>
<div class="col-auto"><button class="btn btn-outline-secondary">{{ __('app.filter') }}</button></div></form>
<a href="{{ route('admin.invoices.create') }}" class="btn btn-primary">+ {{ __('app.invoices') }}</a></div>
<div class="card"><div class="table-responsive"><table class="table table-striped mb-0"><thead><tr><th>{{ __('app.invoice_number') }}</th><th>{{ __('app.customer') }}</th><th>{{ __('app.total') }}</th><th>{{ __('app.status') }}</th><th>{{ __('app.due_date') }}</th><th>{{ __('app.actions') }}</th></tr></thead><tbody>
@foreach($invoices as $invoice)<tr><td><a href="{{ route('admin.invoices.show',$invoice) }}">#{{ $invoice->invoice_number }}</a></td><td>{{ $invoice->customer?->name }}</td><td>{{ number_format($invoice->total,2) }}</td><td>{{ $invoice->status }}</td><td>{{ optional($invoice->due_date)->format('Y-m-d') }}</td><td class="d-flex gap-2"><a class="btn btn-sm btn-outline-primary" href="{{ route('admin.invoices.edit',$invoice) }}">{{ __('app.edit') }}</a><form method="POST" action="{{ route('admin.invoices.destroy',$invoice) }}">@csrf @method('DELETE')<button data-confirm="{{ __('app.confirm_delete') }}" class="btn btn-sm btn-outline-danger">{{ __('app.delete') }}</button></form></td></tr>@endforeach
</tbody></table></div></div><div class="mt-3">{{ $invoices->links() }}</div>
@endsection
