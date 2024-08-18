@extends('start.layout')

@section('title', 'Home Page')

@section('styles-links')

@endsection

@section('nav-links')
    <a class="nav-link nav-letterSpacing active" aria-current="page" href="/">HOME</a>
    <a class="nav-link nav-letterSpacing" href="{{ route('login') }}">LOGIN</a>
    <a class="nav-link nav-letterSpacing" href="{{ route('register') }}">REGISTER</a>
@endsection

@section('main-content')
    <div class="container">
        <h1 class="h1">Home</h1>
        @if (Auth::check())
            <div class="home-logout p-4 w-75 rounded" style="background-color: rgb(255, 255, 255, 0.7);">
                <h2 class="h2">You are currently logged in, press the log out button.</h2>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary"><i
                            class="me-2 fa-solid fa-arrow-right-from-bracket rotate"></i>
                        {{ __('Log Out') }}</button>
                </form>
            </div>
        @endif
    </div>
@endsection

@section('scripts')
@endsection
