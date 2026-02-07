@extends('layouts.admin')
@section('title', __('app.edit'))
@section('content')
<div class="card p-3"><form method="POST" action="{{ route('admin.customers.update',$customer) }}">@method('PUT') @include('admin.customers.form')</form></div>
@endsection
