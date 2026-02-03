<!doctype html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', __('app.admin_dashboard'))</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @if (app()->getLocale() === 'ar')
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    @endif
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/rtl.css') }}">
</head>
<body class="bg-light">
    <div class="d-flex">
        <aside class="bg-white border-end vh-100 p-3" style="width: 240px;">
            <h5 class="fw-bold mb-4">Mostafa CMS</h5>
            <nav class="nav flex-column">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">{{ __('app.dashboard') }}</a>
                <div class="mt-3 text-uppercase small text-muted">{{ __('app.cms') }}</div>
                <a class="nav-link" href="{{ route('admin.profile.edit') }}">{{ __('app.profile') }}</a>
                <a class="nav-link" href="{{ route('admin.services.index') }}">{{ __('app.services') }}</a>
                <a class="nav-link" href="{{ route('admin.projects.index') }}">{{ __('app.projects') }}</a>
                <a class="nav-link" href="{{ route('admin.clients.index') }}">{{ __('app.clients') }}</a>
                <div class="mt-3 text-uppercase small text-muted">{{ __('app.crm') }}</div>
                <a class="nav-link disabled" href="#">{{ __('app.customers') }}</a>
                <div class="mt-3 text-uppercase small text-muted">{{ __('app.accounting') }}</div>
                <a class="nav-link disabled" href="#">{{ __('app.invoices') }}</a>
                <div class="mt-3 text-uppercase small text-muted">{{ __('app.reports') }}</div>
                <a class="nav-link disabled" href="#">{{ __('app.reports') }}</a>
                <div class="mt-3 text-uppercase small text-muted">{{ __('app.settings') }}</div>
                <a class="nav-link" href="{{ route('admin.messages.index') }}">{{ __('app.messages') }}</a>
                <a class="nav-link" href="{{ route('admin.settings.edit') }}">{{ __('app.site_settings') }}</a>
            </nav>
        </aside>
        <div class="flex-grow-1">
            <nav class="navbar navbar-light bg-white border-bottom px-4">
                <form class="d-none d-md-flex me-auto" role="search">
                    <input class="form-control form-control-sm" type="search" placeholder="{{ __('app.search') }}">
                </form>
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('admin.projects.create') }}" class="btn btn-outline-primary btn-sm">+ {{ __('app.projects') }}</a>
                    <button class="btn btn-outline-secondary btn-sm" disabled>+ {{ __('app.invoices') }}</button>
                    <button class="btn btn-outline-secondary btn-sm" disabled>+ {{ __('app.expenses') }}</button>
                    <a href="{{ route('lang.switch', app()->getLocale() === 'ar' ? 'en' : 'ar') }}" class="btn btn-outline-secondary btn-sm">
                        {{ app()->getLocale() === 'ar' ? 'EN' : 'AR' }}
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-outline-danger btn-sm">{{ __('app.logout') }}</button>
                    </form>
                </div>
            </nav>
            <main class="p-4">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).on('click', '[data-confirm]', function (event) {
            if (!confirm($(this).data('confirm'))) {
                event.preventDefault();
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
