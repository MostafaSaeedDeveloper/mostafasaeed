@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-semibold">{{ __('messages.reports') }}</h1>
    <div class="mt-6 grid gap-6 md:grid-cols-2">
        <div class="rounded bg-white p-6 shadow">
            <h2 class="text-lg font-semibold">{{ __('messages.profit_loss') }}</h2>
            <ul class="mt-2 text-sm">
                <li>{{ __('messages.income') }}: {{ number_format($profitAndLoss['income'], 2) }}</li>
                <li>{{ __('messages.payments') }}: {{ number_format($profitAndLoss['payments'], 2) }}</li>
                <li>{{ __('messages.expenses') }}: {{ number_format($profitAndLoss['expenses'], 2) }}</li>
                <li>{{ __('messages.net_profit') }}: {{ number_format($profitAndLoss['net'], 2) }}</li>
            </ul>
        </div>
        <div class="rounded bg-white p-6 shadow">
            <h2 class="text-lg font-semibold">{{ __('messages.invoice_aging') }}</h2>
            <ul class="mt-2 text-sm">
                <li>{{ __('messages.overdue') }}: {{ $invoiceAging['overdue'] }}</li>
                <li>{{ __('messages.due_soon') }}: {{ $invoiceAging['due_soon'] }}</li>
            </ul>
        </div>
    </div>
@endsection
