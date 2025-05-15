@extends('veterinarian.layouts.auth')
@section('title')
    {{ __('Login') }}
@endsection
@section('content')
<form method="POST" class="mt-4 pt-2" action="{{route('veterinarian.register.store')}}">
    @csrf
    <div class="mb-3">
        <label class="form-label">Name</label>
        <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
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
        <div class="flex-grow-1">
            <label class="form-label">Clinic</label>
            @if(isset($clinics) && count($clinics) > 0)
                <select class="form-select" id="clinicId" name="clinicId">
                    @foreach($clinics as $clinic)
                        <option value="{{ $clinic->id }}">{{ $clinic->name }}</option>
                    @endforeach
                </select>
            @endif
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Password</label>
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
@endsection
