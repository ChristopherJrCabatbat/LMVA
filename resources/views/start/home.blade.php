@extends('start.layout')

@section('title', 'Home Page')

@section('styles-links')
    <style>
        main {
            padding-top: 12vh;
            min-height: 150vh;
        }

        h1.services {
            background-color: rgb(35, 52, 140, 0.9);
            border: 1px solid rgb(35, 52, 140);

            /* background-color: rgb(32, 186, 236, 0.9); */
            /* border: 1px solid rgb(32, 186, 236); */

            box-shadow: 0 4px 12px rgba(35, 52, 140, 0.5), 0 8px 24px rgba(35, 52, 140, 0.4);
            width: 25rem;

        }

        .card {
            box-shadow: 0 4px 12px rgba(35, 52, 140, 0.5), 0 8px 24px rgba(35, 52, 140, 0.4);
            background-color: rgb(255, 255, 255, 0.8);
        }
    </style>
@endsection

@section('nav-links')
    <a class="nav-link nav-letterSpacing active" aria-current="page" href="/">HOME</a>
    <a class="nav-link nav-letterSpacing" href="{{ route('login') }}">LOGIN</a>
    <a class="nav-link nav-letterSpacing" href="{{ route('register') }}">REGISTER</a>
@endsection

@section('main-content')
    <div class="container">
        @if (Auth::check())
            <div class="home-logout p-4 w-75 rounded">
                <h2 class="h2">You are currently logged in, press the log out button.</h2>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary"><i
                            class="me-2 fa-solid fa-arrow-right-from-bracket rotate"></i>
                        {{ __('Log Out') }}</button>
                </form>
            </div>
        @else
            <h1 class="h1 services text-white mb-4 text-center mx-auto p-2 rounded">Our Services:</h1>
            <div class="d-flex flex-column gap-5 justify-content-center align-items-center">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <div class="col">
                        <div
                            class="card h-100 text-center d-flex flex-column align-items-center justify-content-center p-2">
                            <img src="{{ asset('images/medical.png') }}" class="card-img-top mt-3" alt="..."
                                style="height: 100%; width: 100px">

                            <div class="card-body">
                                <h5 class="card-title">Virtual Medical Scribe</h5>
                                <p class="card-text">LMVA provides healthcare professional who remotely accompanies a
                                    physician during patient visits, taking critical notes and documenting each encounter.
                                    They handle all electronic medical records and clinical charting off-site, allowing
                                    physicians to focus on in-person patient care.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div
                            class="card h-100 text-center d-flex flex-column align-items-center justify-content-center p-2">
                            <img src="{{ asset('images/medical.png') }}" class="card-img-top mt-3" alt="..."
                                style="height: 100%; width: 100px">

                            <div class="card-body">
                                <h5 class="card-title">Virtual Medical Scribe</h5>
                                <p class="card-text">LMVA provides healthcare professional who remotely accompanies a
                                    physician during patient visits, taking critical notes and documenting each encounter.
                                    They handle all electronic medical records and clinical charting off-site, allowing
                                    physicians to focus on in-person patient care.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div
                            class="card h-100 text-center d-flex flex-column align-items-center justify-content-center p-2">
                            <img src="{{ asset('images/medical.png') }}" class="card-img-top mt-3" alt="..."
                                style="height: 100%; width: 100px">

                            <div class="card-body">
                                <h5 class="card-title">Virtual Medical Scribe</h5>
                                <p class="card-text">LMVA provides healthcare professional who remotely accompanies a
                                    physician during patient visits, taking critical notes and documenting each encounter.
                                    They handle all electronic medical records and clinical charting off-site, allowing
                                    physicians to focus on in-person patient care.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <div class="col">
                        <div class="card h-100">
                            <img src="..." class="card-img-top" alt="...">
                            <div class="card-body text-center">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to
                                    additional content. This content is a little bit longer.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100">
                            <img src="..." class="card-img-top" alt="...">
                            <div class="card-body text-center">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This card has supporting text below as a natural lead-in to additional
                                    content.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100">
                            <img src="..." class="card-img-top" alt="...">
                            <div class="card-body text-center">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to
                                    additional content. This card has even longer content than the first to show that equal
                                    height action.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <div class="col">
                        <div class="card h-100">
                            <img src="..." class="card-img-top" alt="...">
                            <div class="card-body text-center">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to
                                    additional content. This content is a little bit longer.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100">
                            <img src="..." class="card-img-top" alt="...">
                            <div class="card-body text-center">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This card has supporting text below as a natural lead-in to additional
                                    content.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100">
                            <img src="..." class="card-img-top" alt="...">
                            <div class="card-body text-center">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to
                                    additional content. This card has even longer content than the first to show that equal
                                    height action.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('scripts')
@endsection
