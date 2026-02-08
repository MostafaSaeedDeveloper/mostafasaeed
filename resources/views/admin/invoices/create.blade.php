@extends('layouts.admin')
@section('title', 'Create Invoice')
@section('page_title', 'Create Invoice')
@section('content')
<form method="POST" action="{{ route('admin.invoices.store') }}">@include('admin.invoices.form')</form>
@endsection
