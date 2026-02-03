@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-semibold">{{ __('messages.contact_messages') }}</h1>
    <div class="mt-6 overflow-hidden rounded bg-white shadow">
        <table class="w-full text-sm">
            <thead class="bg-slate-100 text-left">
                <tr>
                    <th class="px-4 py-2">{{ __('messages.name') }}</th>
                    <th class="px-4 py-2">{{ __('messages.email') }}</th>
                    <th class="px-4 py-2">{{ __('messages.service') }}</th>
                    <th class="px-4 py-2"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($messages as $message)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $message->name }}</td>
                        <td class="px-4 py-2">{{ $message->email }}</td>
                        <td class="px-4 py-2">{{ $message->service }}</td>
                        <td class="px-4 py-2 text-right">
                            <a class="text-indigo-600" href="{{ route('admin.contacts.show', $message) }}">{{ __('messages.view') }}</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
