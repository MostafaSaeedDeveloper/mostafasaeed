@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-semibold">{{ __('messages.edit_revenue') }}</h1>
    <form class="mt-6 rounded bg-white p-6 shadow" method="POST" action="{{ route('admin.revenues.update', $revenue) }}">
        @csrf
        @method('PUT')
        @include('admin.revenues.form', ['revenue' => $revenue])
    </form>
@endsection
