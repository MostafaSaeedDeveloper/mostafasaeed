@extends('layouts.admin')

@section('content')
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-semibold">{{ __('messages.payments') }}</h1>
        <a class="rounded bg-slate-900 px-3 py-2 text-white" href="{{ route('admin.payments.create') }}">{{ __('messages.add') }}</a>
    </div>
    <div class="mt-6 overflow-hidden rounded bg-white shadow">
        <table class="w-full text-sm">
            <thead class="bg-slate-100 text-left">
                <tr>
                    <th class="px-4 py-2">{{ __('messages.customer') }}</th>
                    <th class="px-4 py-2">{{ __('messages.amount') }}</th>
                    <th class="px-4 py-2">{{ __('messages.date') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payments as $payment)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $payment->customer?->name }}</td>
                        <td class="px-4 py-2">{{ $payment->amount }}</td>
                        <td class="px-4 py-2">{{ $payment->paid_at?->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
