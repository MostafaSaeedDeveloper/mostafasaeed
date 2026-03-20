@extends('layouts.admin')
@section('title', 'Reports')
@section('page_title', 'Reports')
@section('content')
<div class="row g-3 mb-4"><div class="col-lg-8"><div class="card"><div class="card-header">Current Year Summary</div><div class="table-responsive"><table class="table mb-0"><thead><tr><th>Month</th><th>Revenue</th><th>Expenses</th><th>Net Profit</th></tr></thead><tbody>@foreach($rows as $row)<tr><td>{{ $row['label'] }}</td><td>{{ number_format($row['revenue'],2) }}</td><td>{{ number_format($row['expenses'],2) }}</td><td>{{ number_format($row['net'],2) }}</td></tr>@endforeach</tbody></table></div></div></div><div class="col-lg-4"><div class="card"><div class="card-header">Top Clients by Revenue</div><ul class="list-group list-group-flush">@forelse($topClients as $client)<li class="list-group-item d-flex justify-content-between"><span>{{ $client->name }}</span><span>{{ number_format($client->revenue,2) }}</span></li>@empty<li class="list-group-item text-muted">No revenue yet.</li>@endforelse</ul></div></div></div>
<div class="card"><div class="card-body"><canvas id="reportsChart" height="120"></canvas></div></div>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
new Chart(document.getElementById('reportsChart'), {type:'line',data:{labels:@json($rows->pluck('label')),datasets:[{label:'Revenue',data:@json($rows->pluck('revenue')),borderColor:'#198754'},{label:'Expenses',data:@json($rows->pluck('expenses')),borderColor:'#dc3545'},{label:'Net Profit',data:@json($rows->pluck('net')),borderColor:'#0d6efd'}]}});
</script>
@endpush
