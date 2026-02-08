@extends('layouts.admin')
@section('title', 'Edit Payment Method')
@section('page_title', 'Edit Payment Method')
@section('content')
<form method="POST" enctype="multipart/form-data" action="{{ route('admin.payment-methods.update',$method) }}">@method('PUT')@include('admin.payment-methods.form')</form>
@endsection
