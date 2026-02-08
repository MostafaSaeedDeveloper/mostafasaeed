@extends('layouts.admin')
@section('title', 'Payment Methods')
@section('page_title', 'Payment Methods')
@section('breadcrumb')
<ol class="breadcrumb float-sm-right"><li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li><li class="breadcrumb-item active">Payment Methods</li></ol>
@endsection
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between"><h3 class="card-title">Manage methods</h3><a href="{{ route('admin.payment-methods.create') }}" class="btn btn-primary btn-sm">Add Method</a></div>
    <div class="card-body table-responsive">
        <table class="table table-bordered table-hover datatable">
            <thead><tr><th>Name</th><th>Client Label</th><th>Status</th><th>Default</th><th>Actions</th></tr></thead>
            <tbody>@foreach($methods as $method)<tr><td>{{ $method->name }}</td><td>{{ $method->customer_label }}</td><td><span class="badge badge-{{ $method->is_active ? 'success':'secondary' }}">{{ $method->is_active ? 'Active':'Inactive' }}</span></td><td>{!! $method->is_default ? '<span class="badge badge-primary">Default</span>' : '-' !!}</td><td class="d-flex gap-2"><a href="{{ route('admin.payment-methods.edit',$method) }}" class="btn btn-sm btn-outline-primary">Edit</a><form method="POST" action="{{ route('admin.payment-methods.destroy',$method) }}">@csrf @method('DELETE')<button data-confirm="{{ __('app.confirm_delete') }}" class="btn btn-sm btn-outline-danger">Delete</button></form></td></tr>@endforeach</tbody>
        </table>
    </div>
</div>
@endsection
