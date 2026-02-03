@extends('layouts.admin')

@section('title', __('app.messages'))

@section('content')
<div class="card">
    <div class="table-responsive">
        <table class="table table-striped mb-0">
            <thead>
                <tr>
                    <th>{{ __('app.name') }}</th>
                    <th>{{ __('app.email') }}</th>
                    <th>{{ __('app.service') }}</th>
                    <th>{{ __('app.received_at') }}</th>
                    <th>{{ __('app.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($messages as $message)
                    <tr>
                        <td>{{ $message->name }}</td>
                        <td>{{ $message->email }}</td>
                        <td>{{ $message->service }}</td>
                        <td>{{ $message->created_at->format('Y-m-d') }}</td>
                        <td>
                            <a href="{{ route('admin.messages.show', $message) }}" class="btn btn-sm btn-outline-secondary">{{ __('app.view') }}</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">
    {{ $messages->links() }}
</div>
@endsection
