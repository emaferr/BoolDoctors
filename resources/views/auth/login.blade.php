@extends('layouts.log')

@section('title', '| Login')

@section('content')
<div style="height: 100vh" class="container padding-top">
    <div class="row justify-content-center">
        <div class="col-md-8 d-flex justify-content-center p-5">
            <div class="card-responsive border">

                <div class="card-header"><img width="200" class="img-fluid" src="{{ asset('img/logo_small.png') }}" alt="BoolDoctors logo"></div>

                <div class="card-body d-flex">
                    <div class="text-center pt-md-5 my-md-5 login-icon">
                        <i class="fas fa-user-md dt-icon"></i>
                    </div>
                    <form method="POST" action="{{ route('login') }}" class="d-flex flex-column justify-content-center">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right text-nowrap">{{ __('Indirizzo E-Mail') }}</label>

                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-8">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Ricordami') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4 text-center">
                                <button type="submit" class="btn text-white btn-lg my-3 form-button">
                                    {{ __('Accedi') }}
                                </button>

                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Password dimenticata?') }}
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

@endsection