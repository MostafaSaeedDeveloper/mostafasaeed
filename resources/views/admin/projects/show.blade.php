@extends('layouts.admin')
@section('title', $project->getTranslated('title'))
@section('page_title', 'Project Details')
@section('content')
<div class="card mb-4"><div class="card-body"><h3>{{ $project->getTranslated('title') }}</h3><p><strong>Client:</strong> {{ $project->client?->name }}</p><p><strong>Category:</strong> {{ ucfirst(str_replace('_',' ', $project->category)) }}</p><p><strong>Status:</strong> {{ ucfirst(str_replace('_',' ', $project->status)) }}</p><p><strong>Budget:</strong> {{ number_format($project->budget,2) }}</p><p class="mb-0"><strong>Description:</strong> {{ $project->description }}</p></div></div>
<div class="row g-3"><div class="col-md-6"><div class="card"><div class="card-header">Related Tasks</div><div class="card-body text-muted">Tasks module not available yet.</div></div></div><div class="col-md-6"><div class="card"><div class="card-header">Related Invoices</div><ul class="list-group list-group-flush">@forelse($project->invoices as $invoice)<li class="list-group-item d-flex justify-content-between"><span>{{ $invoice->formatted_number }}</span><span>{{ number_format($invoice->total,2) }}</span></li>@empty<li class="list-group-item text-muted">No invoices.</li>@endforelse</ul></div></div></div>
@endsection
