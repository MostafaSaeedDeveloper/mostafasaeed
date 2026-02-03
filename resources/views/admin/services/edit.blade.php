@extends('layouts.admin')

@section('title', __('app.edit_service'))

@section('content')
<form method="POST" action="{{ route('admin.services.update', $service) }}" class="card p-4">
    @csrf
    @method('PUT')
    @include('admin.services.form', ['service' => $service])
    <button class="btn btn-primary">{{ __('app.save') }}</button>
</form>
@endsection
