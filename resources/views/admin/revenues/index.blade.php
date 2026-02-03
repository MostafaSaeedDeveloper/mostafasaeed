@extends('layouts.admin')

@section('title', __('app.revenues'))

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
                @foreach($revenues as $revenue)
                    <tr>
                        <td>{{ $revenue->category?->name ?? $revenue->source }}</td>
                        <td>{{ number_format($revenue->amount, 2) }}</td>
                        <td>{{ $revenue->account?->name }}</td>
                        <td>{{ optional($revenue->date)->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">
    {{ $revenues->links() }}
</div>
@endsection
