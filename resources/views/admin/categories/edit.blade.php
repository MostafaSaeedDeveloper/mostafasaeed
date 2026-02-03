@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-semibold">{{ __('messages.edit_category') }}</h1>
    <form class="mt-6 rounded bg-white p-6 shadow" method="POST" action="{{ route('admin.categories.update', $category) }}">
        @csrf
        @method('PUT')
        @include('admin.categories.form', ['category' => $category])
    </form>
@endsection
