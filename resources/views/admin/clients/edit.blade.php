@extends('layouts.admin')
@section('title', 'Edit Client')
@section('page_title', 'Edit Client')
@section('content')
<form method="POST" action="{{ route('admin.clients.update', $client) }}" class="card p-4">@method('PUT') @include('admin.clients.form', ['client' => $client])<div class="mt-3"><button class="btn btn-primary">Update Client</button></div></form>
@endsection
