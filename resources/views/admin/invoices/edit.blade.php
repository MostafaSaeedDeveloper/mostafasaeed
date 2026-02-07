@extends('layouts.admin')
@section('title', __('app.edit'))
@section('content')<div class="card p-3"><form method="POST" action="{{ route('admin.invoices.update',$invoice) }}">@method('PUT') @include('admin.invoices.form')</form></div>@endsection
