@extends('layouts.admin')

@section('title', __('app.customers'))

@section('content')
<div class="card">
    <div class="table-responsive">
        <table class="table table-striped mb-0">
            <thead>
                <tr>
                    <th>{{ __('app.name') }}</th>
                    <th>{{ __('app.email') }}</th>
                    <th>{{ __('app.phone') }}</th>
                    <th>{{ __('app.status') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $customer)
                    <tr>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->phone }}</td>
                        <td>{{ $customer->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">
    {{ $customers->links() }}
</div>
@endsection
