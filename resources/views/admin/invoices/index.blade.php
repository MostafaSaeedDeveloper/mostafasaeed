@extends('layouts.admin')
@section('title', 'Invoices')
@section('page_title', 'Invoices')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-end gap-3">
        <form method="GET" class="row g-2 w-100">
            <div class="col-md-5"><input type="text" name="q" class="form-control" placeholder="Search by invoice or client" value="{{ request('q') }}"></div>
            <div class="col-md-3"><select name="status" class="form-select"><option value="">All statuses</option>@foreach(['draft','sent','paid','overdue','cancelled'] as $status)<option value="{{ $status }}" @selected(request('status')===$status)>{{ ucfirst($status) }}</option>@endforeach</select></div>
            <div class="col-md-2"><button class="btn btn-outline-secondary">Filter</button></div>
        </form>
        <a href="{{ route('admin.invoices.create') }}" class="btn btn-primary">Add Invoice</a>
    </div>
    <div class="table-responsive"><table class="table mb-0"><thead><tr><th>Invoice</th><th>Client</th><th>Project</th><th>Total</th><th>Status</th><th>Due</th><th>Actions</th></tr></thead><tbody>
        @foreach($invoices as $invoice)
        <tr><td>{{ $invoice->formatted_number }}</td><td>{{ $invoice->client?->name }}</td><td>{{ $invoice->project?->getTranslated('title') }}</td><td>{{ number_format($invoice->total,2) }} {{ $invoice->currency }}</td><td>{{ ucfirst($invoice->status) }}</td><td>{{ optional($invoice->due_date)->format('Y-m-d') }}</td><td class="d-flex gap-2"><a href="{{ route('admin.invoices.show',$invoice) }}" class="btn btn-sm btn-outline-dark">Show</a><a href="{{ route('admin.invoices.edit',$invoice) }}" class="btn btn-sm btn-outline-primary">Edit</a><form method="POST" action="{{ route('admin.invoices.destroy',$invoice) }}">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger">Delete</button></form></td></tr>
        @endforeach
    </tbody><tfoot><tr><th colspan="3">Page totals</th><th>{{ number_format($totals['grand_total'],2) }}</th><th></th><th></th><th></th></tr></tfoot></table></div>
</div>
<div class="mt-3">{{ $invoices->links() }}</div>
@endsection
