@extends('layouts.admin')

@section('content')
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-semibold">{{ __('messages.clients') }}</h1>
        <a class="rounded bg-slate-900 px-3 py-2 text-white" href="{{ route('admin.clients.create') }}">{{ __('messages.add') }}</a>
    </div>
    <div class="mt-6 overflow-hidden rounded bg-white shadow">
        <table class="w-full text-sm">
            <thead class="bg-slate-100 text-left">
                <tr>
                    <th class="px-4 py-2">{{ __('messages.name') }}</th>
                    <th class="px-4 py-2">{{ __('messages.featured') }}</th>
                    <th class="px-4 py-2"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($clients as $client)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $client->name }}</td>
                        <td class="px-4 py-2">{{ $client->is_featured ? __('messages.yes') : __('messages.no') }}</td>
                        <td class="px-4 py-2 text-right">
                            <a class="text-indigo-600" href="{{ route('admin.clients.edit', $client) }}">{{ __('messages.edit') }}</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
