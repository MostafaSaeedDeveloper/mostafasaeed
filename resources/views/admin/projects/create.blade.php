@extends('layouts.admin')

@section('title', __('app.add_project'))

@section('content')
<form method="POST" action="{{ route('admin.projects.store') }}" class="card p-4" enctype="multipart/form-data">
    @csrf
    @include('admin.projects.form')
    <button class="btn btn-primary">{{ __('app.save') }}</button>
</form>
@endsection
