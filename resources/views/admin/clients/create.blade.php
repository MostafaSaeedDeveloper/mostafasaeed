@extends('layouts.admin')
@section('title', 'Create Client')
@section('page_title', 'Create Client')
@section('content')
<form method="POST" action="{{ route('admin.clients.store') }}" class="card p-4">@include('admin.clients.form')<div class="mt-3"><button class="btn btn-primary">Save Client</button></div></form>
@endsection
