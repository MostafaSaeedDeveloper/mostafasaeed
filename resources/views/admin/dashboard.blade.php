@extends('layouts.admin')
@section('title', __('app.dashboard'))
@section('content')
<div class="row g-3 mb-4">
@foreach([
['label'=>__('app.monthly_revenue'),'value'=>number_format($monthlyRevenue,2)],
['label'=>__('app.monthly_expenses'),'value'=>number_format($monthlyExpenses,2)],
['label'=>__('app.net_profit'),'value'=>number_format($netProfit,2)],
['label'=>__('app.unpaid_invoices'),'value'=>$unpaidInvoices.' | '.__('app.total_due').': '.number_format($totalDue,2)]
] as $card)
<div class="col-md-3"><div class="card"><div class="card-body"><div class="text-muted">{{ $card['label'] }}</div><div class="h5">{{ $card['value'] }}</div></div></div></div>
@endforeach
</div>
<div class="card mb-3"><div class="card-header">Quick Actions</div><div class="card-body d-flex gap-2 flex-wrap"><a href="{{ route('admin.invoices.create') }}" class="btn btn-primary">+Invoice</a><a href="{{ route('admin.projects.create') }}" class="btn btn-outline-primary">+Project</a><a href="{{ route('admin.expenses.create') }}" class="btn btn-outline-primary">+Expense</a><a href="{{ route('admin.payments.create') }}" class="btn btn-outline-primary">+Payment</a></div></div>
<div class="card"><div class="card-header">{{ __('app.recent_activity') }}</div><ul class="list-group list-group-flush">@forelse($activities as $activity)<li class="list-group-item d-flex justify-content-between"><span>{{ $activity['label'] }}</span><small>{{ $activity['date']->diffForHumans() }}</small></li>@empty<li class="list-group-item text-muted">{{ __('app.no_activity') }}</li>@endforelse</ul></div>
@endsection
