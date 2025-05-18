@extends('petsitter.layouts.auth')

@section('title')
    {{ __('Login') }}
@endsection

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-sm" style="max-width: 420px; width: 100%; border-radius: 15px;">
        <div class="card-body p-4">
            <h3 class="mb-4 text-center">
                <i class="bi bi-dog-fill text-primary me-2" style="font-size: 1.6rem;"></i>
                Pet Sitter Login
            </h3>

            <form method="POST" action="{{ route('pet-sitter.login.check') }}" novalidate>
                @csrf

                {{-- Email / Username --}}
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input 
                        id="email" 
                        type="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        required 
                        autofocus
                        autocomplete="email"
                        class="form-control @error('email') is-invalid @enderror"
                        placeholder="Enter your email"
                    >
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <label for="password" class="form-label mb-0">Password</label>
                        <a href="{{ route('password.request') }}" class="small text-decoration-none">Forgot password?</a>
                    </div>
                    <div class="input-group">
                        <input 
                            id="password" 
                            type="password" 
                            name="password" 
                            required 
                            autocomplete="current-password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="Enter your password"
                        >
                        <button type="button" class="btn btn-outline-secondary" id="togglePassword" tabindex="-1" aria-label="Toggle password visibility">
                            <i class="bi bi-eye-fill"></i>
                        </button>
                        @error('password')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                {{-- Remember Me --}}
                <div class="mb-4 form-check">
                    <input 
                        type="checkbox" 
                        name="remember" 
                        id="remember" 
                        class="form-check-input" 
                        {{ old('remember') ? 'checked' : '' }}
                    >
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>

                {{-- Submit --}}
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">
                        Log In
                    </button>
                </div>
            </form>

            <div class="mt-3 text-center">
                <small>Don't have an account? <a href="{{ route('shop-vendor.register') }}">Register here</a></small>
            </div>
        </div>
    </div>
</div>

{{-- Password toggle script --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const togglePassword = document.querySelector('#togglePassword');
        const passwordInput = document.querySelector('#password');

        togglePassword.addEventListener('click', () => {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            togglePassword.innerHTML = type === 'password' 
                ? '<i class="bi bi-eye-fill"></i>' 
                : '<i class="bi bi-eye-slash-fill"></i>';
        });
    });
</script>
@endsection
