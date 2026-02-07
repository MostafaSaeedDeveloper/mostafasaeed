@extends('layouts.admin')
@section('title', __('app.reports'))
@section('content')
<form class="row g-2 mb-3"><div class="col-auto"><input type="date" name="from" value="{{ $from }}" class="form-control"></div><div class="col-auto"><input type="date" name="to" value="{{ $to }}" class="form-control"></div><div class="col-auto"><button class="btn btn-outline-secondary">{{ __('app.filter') }}</button></div></form>
<div class="row g-3 mb-3"><div class="col-md-3"><div class="card p-3"><small>{{ __('app.monthly_revenue') }}</small><h4>{{ number_format($revenue,2) }}</h4></div></div><div class="col-md-3"><div class="card p-3"><small>{{ __('app.monthly_expenses') }}</small><h4>{{ number_format($expenses,2) }}</h4></div></div><div class="col-md-3"><div class="card p-3"><small>{{ __('app.net_profit') }}</small><h4>{{ number_format($netProfit,2) }}</h4></div></div><div class="col-md-3"><div class="card p-3"><small>{{ __('app.unpaid_invoices') }}</small><h4>{{ $unpaidInvoices }}</h4></div></div></div>
<div class="card"><div class="card-header">Top Clients</div><ul class="list-group list-group-flush">@forelse($topClients as $client)<li class="list-group-item d-flex justify-content-between"><span>{{ $client->customer_name }}</span><span>{{ number_format($client->total_amount,2) }}</span></li>@empty<li class="list-group-item text-muted">-</li>@endforelse</ul></div>
@endsection
