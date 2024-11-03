@extends('auth.main')

@section('auth-container')
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <!-- Register -->
            <div class="card">
                <div class="card-body">
                    <!-- Logo -->
        <!-- /Logo -->
        <h4 class="mb-2">Welcome to FISHY! 👋</h4>
        <p class="mb-4">Please sign-in to your account and start the adventure</p>
        
        {{-- <form id="formAuthentication" class="mb-3" action="/dashboard" method="GET"> --}}
        <form method="post" action="{{ route('loginProses') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input
                type="email"
                class="form-control"
                id="email"
                name="email"
                placeholder="Enter your email or username"
                />
            </div>
            @error('email')
                <small>{{ $message }}</small>
            @enderror
            <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Password</label>
                </div>
                <div class="input-group input-group-merge">
                    <input
                    type="password"
                    id="password"
                    class="form-control"
                    name="password"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
            </div>
            @error('password')
                <small>{{ $message }}</small>
            @enderror
            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember_me" />
                    <label
                    class="form-check-label"
                    for="remember_me"
                    name="remember"> Remember Me </label>
                </div>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary d-grid w-100">Sign in</button>
            </div>
        </form>
        </div>
    </div>
    <!-- /Register -->
</div>
</div>
</div>
@endsection