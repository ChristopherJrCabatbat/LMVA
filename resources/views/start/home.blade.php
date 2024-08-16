@extends('start.layout')

@section('title', 'Home Page')

@section('styles-links')

@endsection

@section('nav-links')
    <a class="nav-link nav-letterSpacing active" aria-current="page" href="/">HOME</a>
    <a class="nav-link nav-letterSpacing" href="#">CONTACT</a>
    <a class="nav-link nav-letterSpacing" href="{{ route('login') }}">LOGIN</a>
    <a class="nav-link nav-letterSpacing" href="{{ route('register') }}">REGISTER</a>
@endsection

@section('main-content')
    <div class="container">
        <h1 class="h1">Home</h1>
    </div>
@endsection

@section('scripts')
@endsection
