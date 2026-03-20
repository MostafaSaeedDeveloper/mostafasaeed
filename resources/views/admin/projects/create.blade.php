@extends('layouts.admin')
@section('title', 'Create Project')
@section('page_title', 'Create Project')
@section('content')
<form method="POST" action="{{ route('admin.projects.store') }}" class="card p-4">@include('admin.projects.form')<div class="mt-3"><button class="btn btn-primary">Save Project</button></div></form>
@endsection
