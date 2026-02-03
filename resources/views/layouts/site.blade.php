<!doctype html>
<html lang="{{ app()->getLocale() }}" dir="{{ app(\App\Services\LocalizationService::class)->direction() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Mostafa Saeed') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-900">
    <header class="bg-white shadow">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-4">
            <a href="{{ route('home') }}" class="text-xl font-semibold">{{ config('app.name', 'Mostafa Saeed') }}</a>
            <nav class="flex items-center gap-4 text-sm">
                <a href="{{ route('about') }}">{{ __('messages.about') }}</a>
                <a href="{{ route('services') }}">{{ __('messages.services') }}</a>
                <a href="{{ route('projects') }}">{{ __('messages.projects') }}</a>
                <a href="{{ route('clients') }}">{{ __('messages.clients') }}</a>
                <a href="{{ route('contact') }}">{{ __('messages.contact') }}</a>
                <div class="flex items-center gap-2">
                    <a href="{{ route('lang.switch', 'en') }}" class="text-xs">EN</a>
                    <span class="text-xs text-slate-400">|</span>
                    <a href="{{ route('lang.switch', 'ar') }}" class="text-xs">AR</a>
                </div>
            </nav>
        </div>
    </header>

    <main class="mx-auto max-w-6xl px-4 py-10">
        @yield('content')
    </main>

    <footer class="border-t bg-white">
        <div class="mx-auto max-w-6xl px-4 py-6 text-center text-sm text-slate-500">
            {{ __('messages.footer') }}
        </div>
    </footer>
</body>
</html>
