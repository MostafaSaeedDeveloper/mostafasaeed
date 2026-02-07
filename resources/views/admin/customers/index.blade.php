@extends('layouts.admin')

@section('title', __('app.customers'))

@section('content')
<div class="d-flex justify-content-between mb-3">
    <form class="row g-2" method="GET">
        <div class="col-auto"><input name="q" value="{{ request('q') }}" class="form-control" placeholder="{{ __('app.search') }}"></div>
        <div class="col-auto">
            <select name="status" class="form-select">
                <option value="">{{ __('app.status') }}</option>
                @foreach(['lead','active','inactive'] as $status)
                <option value="{{ $status }}" @selected(request('status')===$status)>{{ ucfirst($status) }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-auto"><button class="btn btn-outline-secondary">{{ __('app.filter') }}</button></div>
    </form>
    <a href="{{ route('admin.customers.create') }}" class="btn btn-primary">+ {{ __('app.customers') }}</a>
</div>
<div class="card"><div class="table-responsive">
<table class="table table-striped mb-0"><thead><tr><th>{{ __('app.name') }}</th><th>{{ __('app.email') }}</th><th>{{ __('app.phone') }}</th><th>{{ __('app.status') }}</th><th>{{ __('app.actions') }}</th></tr></thead>
<tbody>
@foreach($customers as $customer)
<tr>
<td><a href="{{ route('admin.customers.show',$customer) }}">{{ $customer->name }}</a></td><td>{{ $customer->email }}</td><td>{{ $customer->phone }}</td><td>{{ ucfirst($customer->status) }}</td>
<td class="d-flex gap-2">
<a class="btn btn-sm btn-outline-primary" href="{{ route('admin.customers.edit',$customer) }}">{{ __('app.edit') }}</a>
<form method="POST" action="{{ route('admin.customers.destroy',$customer) }}">@csrf @method('DELETE')<button data-confirm="{{ __('app.confirm_delete') }}" class="btn btn-sm btn-outline-danger">{{ __('app.delete') }}</button></form>
</td></tr>
@endforeach
</tbody></table></div></div>
<div class="mt-3">{{ $customers->links() }}</div>
@endsection
