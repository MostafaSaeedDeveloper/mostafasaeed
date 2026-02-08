@extends('layouts.admin')
@section('title', 'Edit Invoice')
@section('page_title', 'Edit Invoice')
@section('content')
<form method="POST" action="{{ route('admin.invoices.update',$invoice) }}">@method('PUT') @include('admin.invoices.form')</form>
@endsection
