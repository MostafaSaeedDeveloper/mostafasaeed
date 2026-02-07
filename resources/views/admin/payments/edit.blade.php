@extends('layouts.admin')
@section('content')<div class="card p-3"><form method="POST" action="{{ route('admin.payments.update',$payment) }}">@method('PUT') @include('admin.payments.form')</form></div>@endsection
