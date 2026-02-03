@extends('layouts.admin')

@section('content')
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-semibold">{{ __('messages.accounts') }}</h1>
        <a class="rounded bg-slate-900 px-3 py-2 text-white" href="{{ route('admin.accounts.create') }}">{{ __('messages.add') }}</a>
    </div>
    <div class="mt-6 overflow-hidden rounded bg-white shadow">
        <table class="w-full text-sm">
            <thead class="bg-slate-100 text-left">
                <tr>
                    <th class="px-4 py-2">{{ __('messages.name') }}</th>
                    <th class="px-4 py-2">{{ __('messages.type') }}</th>
                    <th class="px-4 py-2">{{ __('messages.currency') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($accounts as $account)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $account->name }}</td>
                        <td class="px-4 py-2">{{ $account->type }}</td>
                        <td class="px-4 py-2">{{ $account->currency?->code }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
