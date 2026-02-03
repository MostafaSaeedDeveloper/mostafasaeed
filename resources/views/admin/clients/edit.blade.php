@extends('layouts.admin')

@section('title', __('app.edit_client'))

@section('content')
<form method="POST" action="{{ route('admin.clients.update', $client) }}" class="card p-4" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('admin.clients.form', ['client' => $client])
    <button class="btn btn-primary">{{ __('app.save') }}</button>
</form>
@endsection
