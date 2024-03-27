@extends('layouts.auth1')
@section('title')
    Login
@endsection
@section('content')
    <div class="row h-100">
        <div class="col-lg-5 col-12">
            <div id="auth-left">
                <div class="auth-logo" style="margin-bottom: 1rem!important;">
                    <a href="index.html" style="margin: 25%;"><img style="height: 80px;width: 200px;"
                            src="{{ asset('assets/compiled/jpg/LOGO NO REG.png') }}" alt="Logo"></a>
                </div>
                <h1 class="auth-title text-center">Log in.</h1>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group position-relative has-icon-left mb-4">
                        {{-- <input type="text" class="form-control form-control-xl" placeholder="Username"> --}}
                        <input id="nip" type="text"
                            class="form-control form-control-xl @error('nip') is-invalid @enderror" name="nip"
                            value="{{ old('nip') }}" placeholder="NIP User" required autocomplete="nip" autofocus>

                        @error('nip')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="form-control-icon">
                            <i class="bi bi-person"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input id="password" type="password"
                            class="form-control form-control-xl @error('password') is-invalid @enderror" name="password"
                            placeholder="Password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                    </div>
                    <div class="form-check form-check-lg d-flex align-items-end">
                        {{-- <input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault"> --}}
                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label text-gray-600" for="remember">
                            Keep me logged in
                        </label>
                    </div>
                    <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
                </form>
                <div class="text-center mt-5 text-lg fs-4">
                    <p class="text-gray-600"> Don't have an account? <a
                            href="{{ route('password.reset', ['token' => 'token_value']) }}" class="font-bold"> Sign up</a>
                    </p>
                    <p>
                        @if (Route::has('password.request'))
                            <a class="font-bold" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-7 d-none d-lg-block ">
            <div id="auth-right" class="border"
                style="background: unset; background-color: white;backdrop-filter: blur(20px);">
                <img style="width: 100%; height:auto;margin:15% 0;" src="{{ asset('assets/compiled/jpg/LANDSCAPE.jpg') }}"
                    alt="">
            </div>
        </div>
    </div>
    <script>
        // SweetAlert
        // @error('nip')
        //     Swal.fire({
        //         title: 'Failed!',
        //         text: 'Terjadi kesalahan. Silakan coba lagi.',
        //         icon: 'error'
        //     });
        // @enderror
    </script>
@endsection

{{-- @extends('layouts.auth')
@section('title')
    Login
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('NIP User') }}</label>

                                <div class="col-md-6">
                                    <input id="nip" type="text"
                                        class="form-control @error('username') is-invalid @enderror" name="nip"
                                        value="{{ old('username') }}" required autocomplete="username" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection --}}
