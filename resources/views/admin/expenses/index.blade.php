@extends('layouts.admin')

@section('title', __('app.expenses'))

@section('content')
<div class="card">
    <div class="table-responsive">
        <table class="table table-striped mb-0">
            <thead>
                <tr>
                    <th>{{ __('app.category') }}</th>
                    <th>{{ __('app.amount') }}</th>
                    <th>{{ __('app.account') }}</th>
                    <th>{{ __('app.date') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($expenses as $expense)
                    <tr>
                        <td>{{ $expense->category?->name }}</td>
                        <td>{{ number_format($expense->amount, 2) }}</td>
                        <td>{{ $expense->account?->name }}</td>
                        <td>{{ optional($expense->date)->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">
    {{ $expenses->links() }}
</div>
@endsection
