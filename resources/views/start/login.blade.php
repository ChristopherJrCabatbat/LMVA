@extends('start.layout')

@section('title', 'Login')

@section('styles-links')

@endsection

@section('nav-links')
    <a class="nav-link nav-letterSpacing" aria-current="page" href="/">HOME</a>
    <a class="nav-link nav-letterSpacing active" href="{{ route('login') }}">LOGIN</a>
    <a class="nav-link nav-letterSpacing" href="{{ route('register') }}">REGISTER</a>
@endsection

@section('main-content')
    <div class="container text-center w-50 d-flex justify-content-center align-content-center flex-column"
        style="height: 80vh">

        <div class="container p-5 rounded" style="background-color: white;">
            <img src="{{ asset('images/lmva-icon.jpg') }}" class="img-fluid mb-3" style="width: 60px; height: 60px;"
                alt="Logo" />
            <h2 class="h2 mb-3">Log In</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <!-- Email Address -->
                <div class="mb-3 form-floating">
                    <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')"
                        required autofocus autocomplete="username" placeholder="" />
                    <x-input-label class="form-label" for="email" :value="__('Email')" />
                    {{-- <i class="fa-solid fa-triangle-exclamation"></i> --}}
                    <x-input-error :messages="$errors->get('email')" class="mt-3 login-error text-start alert alert-danger" />
                   
                </div>
                <!-- Password -->
                <div class="mb-3 form-floating">
                    <x-text-input id="password" class="form-control" type="password" name="password" required
                        autocomplete="current-password" placeholder="" />
                    <x-input-label class="form-label" for="password" :value="__('Password')" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <!-- Remember Me -->
                <div class="block mt-4 text-start">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>
                <div class="flex items-center justify-end mt-4">
                    {{-- @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif --}}
                    <div class="d-grid mt-3">
                        <x-primary-button class="btn btn-primary">
                            {{ __('Log in') }}
                        </x-primary-button>
                        <div class="mt-3">
                            <span class="text-body-secondary">Not a member yet?</span>
                            <a href="{{ route('register') }}" class="sign-up">Sign up now</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
