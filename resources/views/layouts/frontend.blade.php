<!doctype html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', $settings?->getTranslated('site_name') ?? 'Mostafa Saeed')</title>
    <meta name="description" content="@yield('meta_description', data_get($settings, 'default_seo.description.'.app()->getLocale(), ''))">
    @stack('meta')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @if (app()->getLocale() === 'ar')
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    @endif
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/rtl.css') }}">
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">Mostafa Saeed</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">{{ __('app.nav_home') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">{{ __('app.nav_about') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('services') }}">{{ __('app.nav_services') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('projects') }}">{{ __('app.nav_projects') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('clients') }}">{{ __('app.nav_clients') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">{{ __('app.nav_contact') }}</a></li>
                </ul>
                <div class="ms-lg-3">
                    <a href="{{ route('lang.switch', app()->getLocale() === 'ar' ? 'en' : 'ar') }}" class="btn btn-outline-primary btn-sm">
                        {{ app()->getLocale() === 'ar' ? 'EN' : 'AR' }}
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="py-5">
        @yield('content')
    </main>

    <footer class="bg-light py-4 border-top">
        <div class="container text-center">
            <p class="mb-0 text-muted">{{ __('app.footer_text') }}</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
