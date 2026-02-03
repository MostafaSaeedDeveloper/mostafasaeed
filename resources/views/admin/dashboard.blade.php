@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-semibold">{{ __('messages.dashboard') }}</h1>
    <div class="mt-6 grid gap-4 md:grid-cols-4">
        <div class="rounded bg-white p-4 shadow">
            <p class="text-sm text-slate-500">{{ __('messages.monthly_revenue') }}</p>
            <p class="text-xl font-semibold">{{ number_format($monthlyRevenue, 2) }}</p>
        </div>
        <div class="rounded bg-white p-4 shadow">
            <p class="text-sm text-slate-500">{{ __('messages.monthly_expenses') }}</p>
            <p class="text-xl font-semibold">{{ number_format($monthlyExpenses, 2) }}</p>
        </div>
        <div class="rounded bg-white p-4 shadow">
            <p class="text-sm text-slate-500">{{ __('messages.net_profit') }}</p>
            <p class="text-xl font-semibold">{{ number_format($netProfit, 2) }}</p>
        </div>
        <div class="rounded bg-white p-4 shadow">
            <p class="text-sm text-slate-500">{{ __('messages.total_due') }}</p>
            <p class="text-xl font-semibold">{{ number_format($totalDue, 2) }}</p>
        </div>
    </div>

    <div class="mt-8 grid gap-6 md:grid-cols-2">
        <div class="rounded bg-white p-4 shadow">
            <h2 class="text-lg font-semibold">{{ __('messages.profit_loss') }}</h2>
            <ul class="mt-3 space-y-2 text-sm">
                <li>{{ __('messages.income') }}: {{ number_format($profitAndLoss['income'], 2) }}</li>
                <li>{{ __('messages.payments') }}: {{ number_format($profitAndLoss['payments'], 2) }}</li>
                <li>{{ __('messages.expenses') }}: {{ number_format($profitAndLoss['expenses'], 2) }}</li>
                <li>{{ __('messages.net_profit') }}: {{ number_format($profitAndLoss['net'], 2) }}</li>
            </ul>
        </div>
        <div class="rounded bg-white p-4 shadow">
            <h2 class="text-lg font-semibold">{{ __('messages.recent_payments') }}</h2>
            <ul class="mt-3 space-y-2 text-sm">
                @foreach($recentPayments as $payment)
                    <li>{{ $payment->customer?->name }} - {{ number_format($payment->amount, 2) }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
