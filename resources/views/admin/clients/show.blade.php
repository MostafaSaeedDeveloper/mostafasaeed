@extends('layouts.admin')
@section('title', $client->name)
@section('page_title', 'Client Details')
@section('content')
<div class="card mb-4"><div class="card-body"><h3>{{ $client->name }}</h3><p class="mb-1"><strong>Company:</strong> {{ $client->company }}</p><p class="mb-1"><strong>Email:</strong> {{ $client->email }}</p><p class="mb-1"><strong>Phone:</strong> {{ $client->phone }}</p><p class="mb-1"><strong>Country:</strong> {{ $client->country }}</p><p class="mb-0"><strong>Address:</strong> {{ $client->address }}</p></div></div>
<div class="row g-3">
    <div class="col-md-6"><div class="card"><div class="card-header">Projects</div><ul class="list-group list-group-flush">@forelse($client->projects as $project)<li class="list-group-item">{{ $project->getTranslated('title') }}</li>@empty<li class="list-group-item text-muted">No projects.</li>@endforelse</ul></div></div>
    <div class="col-md-6"><div class="card"><div class="card-header">Invoices</div><ul class="list-group list-group-flush">@forelse($client->invoices as $invoice)<li class="list-group-item d-flex justify-content-between"><span>{{ $invoice->invoice_number }}</span><span>{{ number_format($invoice->total, 2) }}</span></li>@empty<li class="list-group-item text-muted">No invoices.</li>@endforelse</ul></div></div>
</div>
@endsection
