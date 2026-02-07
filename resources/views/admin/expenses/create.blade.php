@extends('layouts.admin')
@section('content')<div class="card p-3"><form method="POST" enctype="multipart/form-data" action="{{ route('admin.expenses.store') }}">@include('admin.expenses.form')</form></div>@endsection
