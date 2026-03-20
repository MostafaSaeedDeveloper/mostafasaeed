<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body class="bg-light">
<div class="container-fluid">
    <div class="row min-vh-100">
        <aside class="col-lg-2 bg-dark text-white p-3">
            <a href="{{ route('admin.dashboard') }}" class="text-white text-decoration-none d-block fs-4 fw-bold mb-4">Mostafa CMS</a>
            <div class="small text-uppercase text-secondary mb-2">Menu</div>
            <div class="nav flex-column gap-1">
                <a href="{{ route('admin.dashboard') }}" class="nav-link text-white {{ request()->routeIs('admin.dashboard') ? 'active bg-primary rounded' : '' }}">Dashboard</a>
                <div class="text-secondary small mt-3">CRM</div>
                <a href="{{ route('admin.clients.index') }}" class="nav-link text-white">Clients</a>
                <a href="{{ route('admin.projects.index') }}" class="nav-link text-white">Projects</a>
                <div class="text-secondary small mt-3">Accounting</div>
                <a href="{{ route('admin.invoices.index') }}" class="nav-link text-white">Billing</a>
                <a href="{{ route('admin.expenses.index') }}" class="nav-link text-white">Expenses</a>
                <a href="{{ route('admin.reports.index') }}" class="nav-link text-white">Reports</a>
                <div class="text-secondary small mt-3">Settings</div>
                <a href="{{ route('admin.settings.edit') }}" class="nav-link text-white">Site Settings</a>
            </div>
        </aside>
        <main class="col-lg-10 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">@yield('page_title', 'Dashboard')</h1>
                <form method="POST" action="{{ route('logout') }}">@csrf<button class="btn btn-outline-danger btn-sm">Logout</button></form>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
            @yield('content')
        </main>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
