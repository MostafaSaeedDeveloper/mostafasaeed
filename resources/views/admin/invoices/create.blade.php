@extends('layouts.admin')
@section('title', __('app.invoices'))
@section('content')<div class="card p-3"><form method="POST" action="{{ route('admin.invoices.store') }}">@include('admin.invoices.form')</form></div>@endsection
