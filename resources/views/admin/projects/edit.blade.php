@extends('layouts.admin')
@section('title', 'Edit Project')
@section('page_title', 'Edit Project')
@section('content')
<form method="POST" action="{{ route('admin.projects.update', $project) }}" class="card p-4">@method('PUT') @include('admin.projects.form')<div class="mt-3"><button class="btn btn-primary">Update Project</button></div></form>
@endsection
