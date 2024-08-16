@extends('start.layout')

@section('title', 'Sign Up')

@section('styles-links')

    <style>
        main {
            padding-top: 33vh;
            min-height: 147vh;
        }

        .form-container {
            padding-top: 500px;
            margin-top: 900px;
        }
    </style>

@endsection

@section('nav-links')
    <a class="nav-link nav-letterSpacing" aria-current="page" href="/">HOME</a>
    <a class="nav-link nav-letterSpacing" href="#">CONTACT</a>
    <a class="nav-link nav-letterSpacing" href="{{ route('login') }}">LOGIN</a>
    <a class="nav-link nav-letterSpacing active" href="{{ route('register') }}">REGISTER</a>
@endsection

@section('main-content')
    <div class="container text-center w-75 d-flex justify-content-center align-content-center flex-column p-4"
        style="height: 80vh">

        <div class="container mt-5 p-5 rounded form-container" style="background-color: white;">
            <img src="{{ asset('images/lmva-icon.jpg') }}" class="img-fluid mb-3" style="width: 60px; height: 60px;"
                alt="Logo" />
            <h2 class="h2 mb-3">Sign Up</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                {{-- Email --}}
                <div class="mb-3 form-floating">
                    <input required type="email" autofocus class="form-control" id="email" name="email"
                        aria-describedby="emailHelp" placeholder="" />
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <div id="emailHelp" class="form-text text-start">
                        We'll never share your email with anyone else.
                    </div>
                </div>

                {{-- Username --}}
                <div class="mb-3 form-floating">
                    <input required type="text" class="form-control" id="username" name="username"
                        aria-describedby="emailHelp" placeholder="" />
                    <label for="exampleInputEmail1" class="form-label">Username</label>
                </div>

                {{-- First Name --}}
                <div class="mb-3 form-floating">
                    <input required type="text" class="form-control" id="first_name" name="first_name"
                        aria-describedby="emailHelp" placeholder="" />
                    <label for="exampleInputEmail1" class="form-label">First Name</label>
                </div>

                {{-- Last Name --}}
                <div class="mb-3 form-floating">
                    <input required type="text" class="form-control" id="last_name" name="last_name"
                        aria-describedby="emailHelp" placeholder="" />
                    <label for="exampleInputEmail1" class="form-label">Last Name</label>
                </div>

                {{-- Contact Number --}}
                <div class="mb-3 form-floating">
                    <input required type="text" class="form-control" id="contact_number" name="contact_number"
                        aria-describedby="emailHelp" placeholder="" />
                    <label for="exampleInputEmail1" class="form-label">Contact Number</label>
                </div>

                {{-- Password --}}
                <div class="mb-3 form-floating">
                    <input required type="password" id="password" name="password" class="form-control"
                        aria-describedby="passwordHelpBlock" placeholder="" />
                    <label for="inputPassword5" class="form-label">Password</label>
                </div>

                {{-- Confirm Password --}}
                <div class="mb-3 form-floating">
                    <input required type="password" id="password_confirmation" name="password_confirmation"
                        class="form-control" aria-describedby="passwordHelpBlock" placeholder="" />
                    <label for="inputPassword5" class="form-label">Confirm Password</label>
                    <div id="passwordHelpBlock" class="form-text text-start">
                        Your password must be 8-20 characters long, contain letters and
                        numbers, and must not contain spaces, special characters, or
                        emoji.
                    </div>
                </div>

                <div class="d-grid mt-3">
                    <x-primary-button class="btn btn-primary">
                        {{ __('Sign up') }}
                    </x-primary-button>
                    <div class="mt-3">
                        <span class="text-body-secondary">Already registered?</span>
                        <a href="{{ route('login') }}" class="sign-up">Log in</a>
                    </div>
                </div>
        </div>
        </form>
    </div>
@endsection

@section('scripts')
@endsection
