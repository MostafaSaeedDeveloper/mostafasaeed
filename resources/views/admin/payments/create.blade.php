@extends('layouts.admin')
@section('title', 'Create Payment')
@section('page_title', 'Create Payment')
@section('content')
<form method="POST" action="{{ route('admin.payments.store') }}">@include('admin.payments.form')</form>
@endsection
