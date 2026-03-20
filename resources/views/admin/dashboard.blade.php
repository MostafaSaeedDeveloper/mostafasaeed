@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page_title', 'Dashboard Overview')
@section('content')
<div class="row g-3 mb-4">
    @foreach ([
        ['label' => 'Monthly Revenue', 'value' => number_format($monthlyRevenue, 2), 'class' => 'success', 'icon' => 'fa-sack-dollar'],
        ['label' => 'Monthly Expenses', 'value' => number_format($monthlyExpenses, 2), 'class' => 'danger', 'icon' => 'fa-wallet'],
        ['label' => 'Net Profit', 'value' => number_format($netProfit, 2), 'class' => 'primary', 'icon' => 'fa-chart-line'],
        ['label' => 'Unpaid Invoices', 'value' => $unpaidInvoices.' / '.number_format($totalDue, 2), 'class' => 'warning', 'icon' => 'fa-file-invoice']
    ] as $card)
        <div class="col-md-3">
            <div class="card border-{{ $card['class'] }} h-100"><div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div><div class="text-muted small">{{ $card['label'] }}</div><div class="fs-4 fw-bold">{{ $card['value'] }}</div></div>
                    <i class="fa-solid {{ $card['icon'] }} text-{{ $card['class'] }}"></i>
                </div>
            </div></div>
        </div>
    @endforeach
</div>
<div class="row g-3 mb-4">
    <div class="col-lg-8"><div class="card"><div class="card-header">Revenue vs Expenses</div><div class="card-body"><canvas id="reChart" height="120"></canvas></div></div></div>
    <div class="col-lg-4"><div class="card"><div class="card-header">Quick Actions</div><div class="card-body d-grid gap-2">
        <a href="{{ route('admin.invoices.create') }}" class="btn btn-primary">+Invoice</a>
        <a href="{{ route('admin.payments.create') }}" class="btn btn-outline-primary">+Payment</a>
        <a href="{{ route('admin.expenses.create') }}" class="btn btn-outline-primary">+Expense</a>
        <a href="{{ route('admin.projects.create') }}" class="btn btn-outline-primary">+Project</a>
    </div></div></div>
</div>
<div class="card">
    <div class="card-header">Recent Activity</div>
    <ul class="list-group list-group-flush">
        @forelse($activities as $activity)
            <li class="list-group-item d-flex justify-content-between"><span>{{ $activity->description }}</span><small>{{ $activity->created_at?->diffForHumans() }}</small></li>
        @empty
            <li class="list-group-item text-muted">No activity yet.</li>
        @endforelse
    </ul>
</div>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
new Chart(document.getElementById('reChart'), {
    type: 'bar',
    data: {
        labels: @json($chartLabels),
        datasets: [
            {label: 'Revenue', data: @json($chartRevenue), backgroundColor: '#198754'},
            {label: 'Expenses', data: @json($chartExpenses), backgroundColor: '#dc3545'}
        ]
    }
});
</script>
@endpush
