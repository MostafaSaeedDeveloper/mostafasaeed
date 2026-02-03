@extends('layouts.site')

@section('content')
    <h1 class="text-3xl font-semibold">{{ __('messages.clients') }}</h1>
    <div class="mt-6 grid gap-4 md:grid-cols-4">
        @foreach($clients as $client)
            <div class="rounded bg-white p-6 text-center shadow">
                <p class="font-semibold">{{ $client->name }}</p>
                @if($client->website)
                    <a class="mt-2 inline-block text-sm text-indigo-600" href="{{ $client->website }}" target="_blank" rel="noopener">{{ __('messages.visit_site') }}</a>
                @endif
            </div>
        @endforeach
    </div>
@endsection
