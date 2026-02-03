@extends('layouts.admin')

@section('title', __('app.clients'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h4 mb-0">{{ __('app.clients') }}</h1>
    <a href="{{ route('admin.clients.create') }}" class="btn btn-primary">{{ __('app.add_client') }}</a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-striped mb-0">
            <thead>
                <tr>
                    <th>{{ __('app.name') }}</th>
                    <th>{{ __('app.featured') }}</th>
                    <th>{{ __('app.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clients as $client)
                    <tr>
                        <td>{{ $client->name }}</td>
                        <td>{{ $client->featured ? __('app.yes') : __('app.no') }}</td>
                        <td>
                            <a href="{{ route('admin.clients.edit', $client) }}" class="btn btn-sm btn-outline-secondary">{{ __('app.edit') }}</a>
                            <form method="POST" action="{{ route('admin.clients.destroy', $client) }}" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" data-confirm="{{ __('app.confirm_delete') }}">{{ __('app.delete') }}</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
