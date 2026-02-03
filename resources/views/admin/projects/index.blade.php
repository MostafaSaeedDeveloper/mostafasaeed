@extends('layouts.admin')

@section('title', __('app.projects'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h4 mb-0">{{ __('app.projects') }}</h1>
    <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">{{ __('app.add_project') }}</a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-striped mb-0">
            <thead>
                <tr>
                    <th>{{ __('app.title') }}</th>
                    <th>{{ __('app.status') }}</th>
                    <th>{{ __('app.featured') }}</th>
                    <th>{{ __('app.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($projects as $project)
                    <tr>
                        <td>{{ $project->getTranslated('title') }}</td>
                        <td>{{ $project->status }}</td>
                        <td>{{ $project->featured ? __('app.yes') : __('app.no') }}</td>
                        <td>
                            <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-sm btn-outline-secondary">{{ __('app.edit') }}</a>
                            <form method="POST" action="{{ route('admin.projects.destroy', $project) }}" class="d-inline">
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
