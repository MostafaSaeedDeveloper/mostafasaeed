@extends('layouts.admin')

@section('title', __('app.add_client'))

@section('content')
<form method="POST" action="{{ route('admin.clients.store') }}" class="card p-4" enctype="multipart/form-data">
    @csrf
    @include('admin.clients.form')
    <button class="btn btn-primary">{{ __('app.save') }}</button>
</form>
@endsection
