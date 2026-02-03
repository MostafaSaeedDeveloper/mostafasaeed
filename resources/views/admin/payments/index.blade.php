@extends('layouts.admin')

@section('title', __('app.payments'))

@section('content')
<div class="card">
    <div class="table-responsive">
        <table class="table table-striped mb-0">
            <thead>
                <tr>
                    <th>{{ __('app.customer') }}</th>
                    <th>{{ __('app.invoice_number') }}</th>
                    <th>{{ __('app.amount') }}</th>
                    <th>{{ __('app.payment_method') }}</th>
                    <th>{{ __('app.date') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payments as $payment)
                    <tr>
                        <td>{{ $payment->customer?->name }}</td>
                        <td>{{ $payment->invoice?->invoice_number ? '#'.$payment->invoice->invoice_number : '-' }}</td>
                        <td>{{ number_format($payment->amount, 2) }}</td>
                        <td>{{ $payment->payment_method }}</td>
                        <td>{{ optional($payment->date)->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">
    {{ $payments->links() }}
</div>
@endsection
