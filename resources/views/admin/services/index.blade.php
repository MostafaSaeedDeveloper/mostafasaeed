@extends('layouts.admin')

@section('content')
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-semibold">{{ __('messages.services') }}</h1>
        <a class="rounded bg-slate-900 px-3 py-2 text-white" href="{{ route('admin.services.create') }}">{{ __('messages.add') }}</a>
    </div>
    <div class="mt-6 overflow-hidden rounded bg-white shadow">
        <table class="w-full text-sm">
            <thead class="bg-slate-100 text-left">
                <tr>
                    <th class="px-4 py-2">{{ __('messages.title') }}</th>
                    <th class="px-4 py-2">{{ __('messages.status') }}</th>
                    <th class="px-4 py-2"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($services as $service)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $service->title[app()->getLocale()] ?? '' }}</td>
                        <td class="px-4 py-2">{{ $service->is_active ? __('messages.active') : __('messages.inactive') }}</td>
                        <td class="px-4 py-2 text-right">
                            <a class="text-indigo-600" href="{{ route('admin.services.edit', $service) }}">{{ __('messages.edit') }}</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
