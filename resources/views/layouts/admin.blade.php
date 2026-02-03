<!doctype html>
<html lang="{{ app()->getLocale() }}" dir="{{ app(\App\Services\LocalizationService::class)->direction() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('messages.admin_panel') }} - {{ config('app.name', 'Mostafa Saeed') }}</title>
    @php($viteEnabled = file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @if($viteEnabled)
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="bg-slate-100 text-slate-900">
    <div class="flex min-h-screen">
        <aside class="w-64 bg-slate-900 text-white">
            <div class="px-6 py-6 text-lg font-semibold">{{ __('messages.admin_panel') }}</div>
            <nav class="space-y-1 px-4 text-sm">
                <a class="block rounded px-3 py-2 hover:bg-slate-800" href="{{ route('admin.dashboard') }}">{{ __('messages.dashboard') }}</a>
                <a class="block rounded px-3 py-2 hover:bg-slate-800" href="{{ route('admin.profile.edit') }}">{{ __('messages.profile') }}</a>
                <a class="block rounded px-3 py-2 hover:bg-slate-800" href="{{ route('admin.services.index') }}">{{ __('messages.services') }}</a>
                <a class="block rounded px-3 py-2 hover:bg-slate-800" href="{{ route('admin.projects.index') }}">{{ __('messages.projects') }}</a>
                <a class="block rounded px-3 py-2 hover:bg-slate-800" href="{{ route('admin.clients.index') }}">{{ __('messages.clients') }}</a>
                <a class="block rounded px-3 py-2 hover:bg-slate-800" href="{{ route('admin.contacts.index') }}">{{ __('messages.contact_messages') }}</a>
                <a class="block rounded px-3 py-2 hover:bg-slate-800" href="{{ route('admin.customers.index') }}">{{ __('messages.customers') }}</a>
                <a class="block rounded px-3 py-2 hover:bg-slate-800" href="{{ route('admin.invoices.index') }}">{{ __('messages.invoices') }}</a>
                <a class="block rounded px-3 py-2 hover:bg-slate-800" href="{{ route('admin.payments.index') }}">{{ __('messages.payments') }}</a>
                <a class="block rounded px-3 py-2 hover:bg-slate-800" href="{{ route('admin.expenses.index') }}">{{ __('messages.expenses') }}</a>
                <a class="block rounded px-3 py-2 hover:bg-slate-800" href="{{ route('admin.revenues.index') }}">{{ __('messages.revenues') }}</a>
                <a class="block rounded px-3 py-2 hover:bg-slate-800" href="{{ route('admin.accounts.index') }}">{{ __('messages.accounts') }}</a>
                <a class="block rounded px-3 py-2 hover:bg-slate-800" href="{{ route('admin.categories.index') }}">{{ __('messages.categories') }}</a>
                <a class="block rounded px-3 py-2 hover:bg-slate-800" href="{{ route('admin.currencies.index') }}">{{ __('messages.currencies') }}</a>
                <a class="block rounded px-3 py-2 hover:bg-slate-800" href="{{ route('admin.reports.index') }}">{{ __('messages.reports') }}</a>
                <a class="block rounded px-3 py-2 hover:bg-slate-800" href="{{ route('admin.settings.edit') }}">{{ __('messages.settings') }}</a>
            </nav>
        </aside>
        <div class="flex flex-1 flex-col">
            <header class="flex items-center justify-between bg-white px-6 py-4 shadow">
                <div class="text-sm text-slate-500">{{ __('messages.welcome_back') }}, {{ auth()->user()->name }}</div>
                <div class="flex items-center gap-4 text-sm">
                    <a href="{{ route('lang.switch', 'en') }}" class="text-xs">EN</a>
                    <span class="text-xs text-slate-400">|</span>
                    <a href="{{ route('lang.switch', 'ar') }}" class="text-xs">AR</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="rounded bg-slate-900 px-3 py-1 text-white" type="submit">{{ __('messages.logout') }}</button>
                    </form>
                </div>
            </header>
            <main class="flex-1 px-6 py-8">
                @if(session('status'))
                    <div class="mb-4 rounded bg-emerald-50 px-4 py-2 text-emerald-700">{{ session('status') }}</div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
