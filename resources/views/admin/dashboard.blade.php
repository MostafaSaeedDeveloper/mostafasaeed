@extends('layouts.admin')

@section('title', __('app.dashboard'))

@section('content')
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="text-muted">{{ __('app.monthly_revenue') }}</div>
                <div class="h4">{{ number_format($monthlyRevenue, 2) }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="text-muted">{{ __('app.monthly_expenses') }}</div>
                <div class="h4">{{ number_format($monthlyExpenses, 2) }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="text-muted">{{ __('app.net_profit') }}</div>
                <div class="h4">{{ number_format($netProfit, 2) }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="text-muted">{{ __('app.unpaid_invoices') }}</div>
                <div class="h4">{{ $unpaidInvoices }}</div>
                <div class="text-muted">{{ __('app.total_due') }}: {{ number_format($totalDue, 2) }}</div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">{{ __('app.recent_activity') }}</div>
    <div class="card-body">
        <ul class="list-group list-group-flush">
            @forelse($recentPayments as $payment)
                <li class="list-group-item d-flex justify-content-between">
                    <span>{{ $payment->reference ?? __('app.payment_received') }}</span>
                    <span>{{ number_format($payment->amount, 2) }}</span>
                </li>
            @empty
                <li class="list-group-item text-muted">{{ __('app.no_activity') }}</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection
