@extends('layouts.masternonauth')

@section('title', 'Login')

@section('headerStyle')
    <link rel="stylesheet" media="screen, print" href="{{ url('public/assets/css/fa-brands.css') }}">
    <link rel="stylesheet" media="screen, print" href="{{ url('public/assets/css/themes/login.css') }}">
@stop

@section('content')
<form method="POST" class="mt-4 pt-2" action="{{route('login')}}">
    @csrf
    <div class="mb-3">
        <label class="form-label">Username</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

        @error('email')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror
    </div>
    <div class="mb-3">
        <div class="d-flex align-items-start">
            <div class="flex-grow-1">
                <label class="form-label">Password</label>
            </div>
            <div class="flex-shrink-0">
                <div class="">
                    <a href="{{ route('password.request') }}" class="text-muted">Forgot password?</a>
                </div>
            </div>
        </div>

        <div class="input-group auth-pass-inputgroup">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
            <button class="btn btn-light shadow-none ms-0" type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                    Remember me
                </label>
            </div>
        </div>

    </div>
    <div class="mb-3">
        <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Log In</button>
    </div>
</form>
    <!-- BEGIN Color profile -->
    <!-- this area is hidden and will not be seen on screens or screen readers -->
    @include('layouts/partials/color-profile')
@stop

@section('footerScript')
    <script>
        $("#js-login-btn").click(function(event) {

            // Fetch form to apply custom Bootstrap validation
            var form = $("#js-login")

            if (form[0].checkValidity() === false) {
                event.preventDefault()
                event.stopPropagation()
            }

            form.addClass('was-validated');
            // Perform ajax submit here...
        });
    </script>
@stop
