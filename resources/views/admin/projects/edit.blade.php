@extends('layouts.admin')

@section('title', __('app.edit_project'))

@section('content')
<form method="POST" action="{{ route('admin.projects.update', $project) }}" class="card p-4" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('admin.projects.form', ['project' => $project])
    <button class="btn btn-primary">{{ __('app.save') }}</button>
</form>
@endsection
