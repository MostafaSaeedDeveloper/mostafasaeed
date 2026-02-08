@extends('layouts.admin')
@section('title', 'Create Payment Method')
@section('page_title', 'Create Payment Method')
@section('content')
<form method="POST" enctype="multipart/form-data" action="{{ route('admin.payment-methods.store') }}">@include('admin.payment-methods.form')</form>
@endsection
