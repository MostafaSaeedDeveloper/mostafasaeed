@extends('layouts.admin')
@section('title', 'Payments')
@section('page_title', 'Payments')
@section('content')
<div class="card"><div class="card-header d-flex justify-content-between"><div>Payments List</div><a href="{{ route('admin.payments.create') }}" class="btn btn-primary">Add Payment</a></div><div class="table-responsive"><table class="table mb-0"><thead><tr><th>Invoice</th><th>Client</th><th>Amount</th><th>Method</th><th>Date</th><th>Actions</th></tr></thead><tbody>@foreach($payments as $payment)<tr><td>{{ $payment->invoice?->invoice_number }}</td><td>{{ $payment->invoice?->client?->name }}</td><td>{{ number_format($payment->amount,2) }}</td><td>{{ $payment->method }}</td><td>{{ optional($payment->payment_date)->format('Y-m-d') }}</td><td class="d-flex gap-2"><a href="{{ route('admin.payments.edit',$payment) }}" class="btn btn-sm btn-outline-primary">Edit</a><form method="POST" action="{{ route('admin.payments.destroy',$payment) }}">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger">Delete</button></form></td></tr>@endforeach</tbody></table></div></div><div class="mt-3">{{ $payments->links() }}</div>
@endsection
