@extends('layouts.admin')

@section('title', __('app.services'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h4 mb-0">{{ __('app.services') }}</h1>
    <a href="{{ route('admin.services.create') }}" class="btn btn-primary">{{ __('app.add_service') }}</a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-striped mb-0">
            <thead>
                <tr>
                    <th>{{ __('app.title') }}</th>
                    <th>{{ __('app.status') }}</th>
                    <th>{{ __('app.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($services as $service)
                    <tr>
                        <td>{{ $service->getTranslated('title') }}</td>
                        <td>{{ $service->status }}</td>
                        <td>
                            <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-sm btn-outline-secondary">{{ __('app.edit') }}</a>
                            <form method="POST" action="{{ route('admin.services.destroy', $service) }}" class="d-inline">
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
