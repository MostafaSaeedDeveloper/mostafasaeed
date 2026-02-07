@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-lg-5 mb-4 mb-lg-0">
            <h2 class="fw-bold">Mostafa CMS</h2>
            <p class="text-muted">Welcome back. Manage clients, projects, invoices and finance from one dashboard.</p>
        </div>
        <div class="col-lg-5">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h5 class="mb-3">{{ __('Login') }}</h5>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="username" class="form-label">{{ __('app.username') }}</label>
                            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                            @error('username')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="form-check"><input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}><label class="form-check-label" for="remember">{{ __('Remember Me') }}</label></div>
                            @if (Route::has('password.request'))<a href="{{ route('password.request') }}" class="small">{{ __('Forgot Your Password?') }}</a>@endif
                        </div>
                        <button type="submit" class="btn btn-primary w-100">{{ __('Login') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
