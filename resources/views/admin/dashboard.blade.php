@extends('layouts.admin')
@section('title', __('app.dashboard'))
@section('page_title', 'Dashboard')
@section('content')
<div class="row">
@foreach([
['label'=>'Monthly Revenue','value'=>number_format($monthlyRevenue,2),'color'=>'success','icon'=>'fa-money-bill-wave'],
['label'=>'Monthly Expenses','value'=>number_format($monthlyExpenses,2),'color'=>'danger','icon'=>'fa-receipt'],
['label'=>'Net Profit','value'=>number_format($netProfit,2),'color'=>'info','icon'=>'fa-chart-line'],
['label'=>'Unpaid Invoices / Total Due','value'=>$unpaidInvoices.' / '.number_format($totalDue,2),'color'=>'warning','icon'=>'fa-file-invoice-dollar']
] as $card)
<div class="col-lg-3 col-6"><div class="small-box bg-{{ $card['color'] }}"><div class="inner"><h4>{{ $card['value'] }}</h4><p>{{ $card['label'] }}</p></div><div class="icon"><i class="fas {{ $card['icon'] }}"></i></div></div></div>
@endforeach
</div>
<div class="row">
<div class="col-md-8"><div class="card"><div class="card-header"><h3 class="card-title">Revenue vs Expenses</h3></div><div class="card-body"><canvas id="revChart" height="90"></canvas></div></div></div>
<div class="col-md-4"><div class="card"><div class="card-header"><h3 class="card-title">Quick Actions</h3></div><div class="card-body d-grid gap-2"><a href="{{ route('admin.invoices.create') }}" class="btn btn-primary">+Invoice</a><a href="{{ route('admin.payments.create') }}" class="btn btn-outline-primary">+Payment</a><a href="{{ route('admin.expenses.create') }}" class="btn btn-outline-primary">+Expense</a><a href="{{ route('admin.projects.create') }}" class="btn btn-outline-primary">+Project</a></div></div></div>
</div>
<div class="card"><div class="card-header"><h3 class="card-title">Recent Activity</h3></div><div class="card-body p-0"><ul class="list-group list-group-flush">@forelse($activities as $activity)<li class="list-group-item d-flex justify-content-between"><span>{{ $activity['label'] }}</span><small>{{ $activity['date']->diffForHumans() }}</small></li>@empty<li class="list-group-item text-muted">{{ __('app.no_activity') }}</li>@endforelse</ul></div></div>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
new Chart(document.getElementById('revChart'),{type:'bar',data:{labels:['Revenue','Expenses'],datasets:[{data:[{{ $monthlyRevenue }},{{ $monthlyExpenses }}],backgroundColor:['#28a745','#dc3545']}]},options:{plugins:{legend:{display:false}}}})
</script>
@endpush
