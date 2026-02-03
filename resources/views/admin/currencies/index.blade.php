@extends('layouts.admin')

@section('content')
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-semibold">{{ __('messages.currencies') }}</h1>
        <a class="rounded bg-slate-900 px-3 py-2 text-white" href="{{ route('admin.currencies.create') }}">{{ __('messages.add') }}</a>
    </div>
    <div class="mt-6 overflow-hidden rounded bg-white shadow">
        <table class="w-full text-sm">
            <thead class="bg-slate-100 text-left">
                <tr>
                    <th class="px-4 py-2">{{ __('messages.code') }}</th>
                    <th class="px-4 py-2">{{ __('messages.symbol') }}</th>
                    <th class="px-4 py-2">{{ __('messages.base') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($currencies as $currency)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $currency->code }}</td>
                        <td class="px-4 py-2">{{ $currency->symbol }}</td>
                        <td class="px-4 py-2">{{ $currency->is_base ? __('messages.yes') : __('messages.no') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
