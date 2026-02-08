@extends('layouts.admin')
@section('title', 'Edit Payment')
@section('page_title', 'Edit Payment')
@section('content')
<form method="POST" action="{{ route('admin.payments.update',$payment) }}">@method('PUT') @include('admin.payments.form')</form>
@endsection
