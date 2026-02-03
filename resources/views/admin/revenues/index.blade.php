@extends('layouts.admin')

@section('content')
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-semibold">{{ __('messages.revenues') }}</h1>
        <a class="rounded bg-slate-900 px-3 py-2 text-white" href="{{ route('admin.revenues.create') }}">{{ __('messages.add') }}</a>
    </div>
    <div class="mt-6 overflow-hidden rounded bg-white shadow">
        <table class="w-full text-sm">
            <thead class="bg-slate-100 text-left">
                <tr>
                    <th class="px-4 py-2">{{ __('messages.date') }}</th>
                    <th class="px-4 py-2">{{ __('messages.amount') }}</th>
                    <th class="px-4 py-2">{{ __('messages.source') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($revenues as $revenue)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $revenue->received_at?->format('Y-m-d') }}</td>
                        <td class="px-4 py-2">{{ $revenue->amount }}</td>
                        <td class="px-4 py-2">{{ $revenue->source }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
