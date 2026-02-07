@extends('layouts.admin')
@section('title', __('app.customers'))
@section('content')
<div class="card p-3"><form method="POST" action="{{ route('admin.customers.store') }}">@include('admin.customers.form',['customer'=>new \App\Models\Customer])</form></div>
@endsection
