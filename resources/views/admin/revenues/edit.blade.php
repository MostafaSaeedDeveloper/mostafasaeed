@extends('layouts.admin')
@section('content')<div class="card p-3"><form method="POST" action="{{ route('admin.revenues.update',$revenue) }}">@method('PUT') @include('admin.revenues.form')</form></div>@endsection
