@extends('layouts.admin')
@section('title', __('app.message_details'))
@section('content')
<div class="card p-3">
<h5>{{ $message->name }} ({{ $message->email }})</h5>
<p><strong>{{ __('app.service') }}:</strong> {{ $message->service ?: '-' }}</p>
<p>{{ $message->message }}</p>
<form method="POST" action="{{ route('admin.messages.update-status',$message) }}" class="row g-2">@csrf @method('PATCH')
<div class="col-auto"><select name="status" class="form-select">@foreach(['new','read','replied','archived'] as $s)<option value="{{ $s }}" @selected($message->status===$s)>{{ ucfirst($s) }}</option>@endforeach</select></div>
<div class="col-auto"><button class="btn btn-primary">{{ __('app.save') }}</button></div>
</form>
</div>
@endsection
