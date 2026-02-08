<!doctype html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', __('app.admin_dashboard'))</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.7.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('css/rtl.css') }}">
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed {{ app()->getLocale() === 'ar' ? 'sidebar-collapse' : '' }}">
<div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a></li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a href="{{ route('lang.switch', app()->getLocale() === 'ar' ? 'en' : 'ar') }}" class="btn btn-outline-secondary btn-sm">{{ app()->getLocale() === 'ar' ? 'EN' : 'AR' }}</a></li>
            <li class="nav-item ml-2">
                <form method="POST" action="{{ route('logout') }}">@csrf<button class="btn btn-outline-danger btn-sm">{{ __('app.logout') }}</button></form>
            </li>
        </ul>
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="{{ route('admin.dashboard') }}" class="brand-link">
            <span class="brand-text font-weight-light">Mostafa CMS</span>
        </a>
        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="nav-icon fas fa-gauge"></i><p>{{ __('app.dashboard') }}</p></a></li>
                    <li class="nav-header">CRM</li>
                    <li class="nav-item"><a href="{{ route('admin.customers.index') }}" class="nav-link {{ request()->routeIs('admin.customers*') ? 'active' : '' }}"><i class="nav-icon fas fa-users"></i><p>{{ __('app.customers') }}</p></a></li>
                    <li class="nav-item"><a href="{{ route('admin.clients.index') }}" class="nav-link {{ request()->routeIs('admin.clients*') ? 'active' : '' }}"><i class="nav-icon fas fa-user-tie"></i><p>{{ __('app.clients') }}</p></a></li>
                    <li class="nav-item"><a href="{{ route('admin.projects.index') }}" class="nav-link {{ request()->routeIs('admin.projects*') ? 'active' : '' }}"><i class="nav-icon fas fa-diagram-project"></i><p>{{ __('app.projects') }}</p></a></li>
                    <li class="nav-header">Accounting</li>
                    <li class="nav-item {{ request()->routeIs('admin.invoices*','admin.payments*','admin.payment-methods*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->routeIs('admin.invoices*','admin.payments*','admin.payment-methods*') ? 'active' : '' }}"><i class="nav-icon fas fa-file-invoice-dollar"></i><p>Billing<i class="right fas fa-angle-left"></i></p></a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item"><a href="{{ route('admin.invoices.index') }}" class="nav-link {{ request()->routeIs('admin.invoices*') ? 'active' : '' }}"><i class="far fa-circle nav-icon"></i><p>{{ __('app.invoices') }}</p></a></li>
                            <li class="nav-item"><a href="{{ route('admin.payments.index') }}" class="nav-link {{ request()->routeIs('admin.payments*') ? 'active' : '' }}"><i class="far fa-circle nav-icon"></i><p>{{ __('app.payments') }}</p></a></li>
                            <li class="nav-item"><a href="{{ route('admin.payment-methods.index') }}" class="nav-link {{ request()->routeIs('admin.payment-methods*') ? 'active' : '' }}"><i class="far fa-circle nav-icon"></i><p>Payment Methods</p></a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a href="{{ route('admin.expenses.index') }}" class="nav-link {{ request()->routeIs('admin.expenses*') ? 'active' : '' }}"><i class="nav-icon fas fa-money-bill-trend-up"></i><p>{{ __('app.expenses') }}</p></a></li>
                    <li class="nav-item"><a href="{{ route('admin.reports.index') }}" class="nav-link {{ request()->routeIs('admin.reports*') ? 'active' : '' }}"><i class="nav-icon fas fa-chart-column"></i><p>{{ __('app.reports') }}</p></a></li>
                    <li class="nav-header">Settings</li>
                    <li class="nav-item"><a href="{{ route('admin.settings.edit') }}" class="nav-link {{ request()->routeIs('admin.settings*') ? 'active' : '' }}"><i class="nav-icon fas fa-gears"></i><p>{{ __('app.site_settings') }}</p></a></li>
                </ul>
            </nav>
        </div>
    </aside>

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6"><h1 class="m-0">@yield('page_title', __('app.dashboard'))</h1></div>
                    <div class="col-sm-6">@yield('breadcrumb')</div>
                </div>
            </div>
        </section>
        <section class="content"><div class="container-fluid">
            @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
            @yield('content')
        </div></section>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap4.min.js"></script>
<script>
$(document).on('click', '[data-confirm]', function (event) { if (!confirm($(this).data('confirm'))) { event.preventDefault(); } });
$('.datatable').DataTable({pageLength: 10, ordering: true});
</script>
@stack('scripts')
</body>
</html>
