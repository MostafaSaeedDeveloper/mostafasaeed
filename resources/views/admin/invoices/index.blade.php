@extends('layouts.admin')

@section('title', __('app.invoices'))

@section('content')
<div class="card">
    <div class="table-responsive">
        <table class="table table-striped mb-0">
            <thead>
                <tr>
                    <th>{{ __('app.invoice_number') }}</th>
                    <th>{{ __('app.customer') }}</th>
                    <th>{{ __('app.total') }}</th>
                    <th>{{ __('app.status') }}</th>
                    <th>{{ __('app.due_date') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoices as $invoice)
                    <tr>
                        <td>#{{ $invoice->invoice_number }}</td>
                        <td>{{ $invoice->customer?->name }}</td>
                        <td>{{ number_format($invoice->total, 2) }}</td>
                        <td>{{ $invoice->status }}</td>
                        <td>{{ optional($invoice->due_date)->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">
    {{ $invoices->links() }}
</div>
@endsection
