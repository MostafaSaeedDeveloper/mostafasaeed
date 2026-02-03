@extends('layouts.admin')

@section('title', __('app.add_service'))

@section('content')
<form method="POST" action="{{ route('admin.services.store') }}" class="card p-4">
    @csrf
    @include('admin.services.form')
    <button class="btn btn-primary">{{ __('app.save') }}</button>
</form>
@endsection
