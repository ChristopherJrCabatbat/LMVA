@extends('start.layout')

@section('title', 'Home Page')

@section('styles-links')
    <link rel="stylesheet" href="{{ asset('css/home-styles.css') }}">
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
                <h2 class="h2">You are currently logged in, please press the log out button.</h2>
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
                            class="card card-ikot h-100 text-center d-flex flex-column align-items-center justify-content-center p-2">

                            <img src="{{ asset('images/home-icons/scribe.png') }}" class="card-img-top mt-3" alt="...">

                            <div class="card-body">
                                <h5 class="card-title">Virtual Medical Scribe</h5>
                                <p class="card-text">Healthcare professionals remotely assist physicians during patient
                                    visits by taking detailed notes and managing electronic medical records. This allows
                                    physicians to focus on in-person patient care.</p>
                            </div>

                            {{-- Flip Effect --}}
                            {{-- <div class="card-inner" >
                                <div class="card-front">
                                    <img src="{{ asset('images/home-icons/scribe.png') }}" class="card-img-top mt-3" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">Virtual Medical Scribe</h5>
                                        <p class="card-text">Healthcare professionals remotely assist physicians during
                                            patient visits by taking detailed notes and managing electronic medical records.
                                            This allows physicians to focus on in-person patient care.</p>
                                    </div>
                                </div>
                                <div class="card-back">
                                    <img src="{{ asset('images/home-icons/scribe.png') }}" class="card-img-top mt-3" alt="...">
                                    <div class="card-body pb-5">
                                        <h5 class="card-title">Ikot Sheesh</h5>
                                        <p class="card-text">You can visit our site here: <a href="">youtube.com</a>
                                        </p>
                                    </div>
                                </div>
                            </div> --}}

                        </div>
                    </div>
                    <div class="col">
                        <div
                            class="card h-100 text-center d-flex flex-column align-items-center justify-content-center p-2">
                            <img src="{{ asset('images/home-icons/medical.png') }}" class="card-img-top mt-3"
                                alt="...">

                            <div class="card-body">
                                <h5 class="card-title">Virtual Administrative Assistant</h5>
                                <p class="card-text">
                                    We help manage daily tasks efficiently, including scheduling, email management, and file
                                    organization, so you can focus on growing your business.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div
                            class="card h-100 text-center d-flex flex-column align-items-center justify-content-center p-2">
                            <img src="{{ asset('images/home-icons/dental.png') }}" class="card-img-top mt-3" alt="...">

                            <div class="card-body">
                                <h5 class="card-title">Dental Virtual Assistants</h5>
                                <p class="card-text">We manage administrative tasks like scheduling, communication, billing,
                                    and insurance coordination, allowing dental professionals to focus on patient care.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <div class="col">
                        <div
                            class="card h-100 text-center d-flex flex-column align-items-center justify-content-center p-2">
                            <img src="{{ asset('images/home-icons/desk.png') }}" class="card-img-top mt-3" alt="...">

                            <div class="card-body">
                                <h5 class="card-title">Virtual Front Desk</h5>
                                <p class="card-text">Offers remote front desk support, including call handling, appointment
                                    scheduling, and customer inquiries. Ensures clients receive professional and timely
                                    assistance, enhancing their experience while allowing in-office staff to focus on other
                                    priorities.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div
                            class="card h-100 text-center d-flex flex-column align-items-center justify-content-center p-2">
                            <img src="{{ asset('images/home-icons/telepresence.png') }}" class="card-img-top mt-3"
                                alt="...">

                            <div class="card-body">
                                <h5 class="card-title">Telepresence Virtual Assistant</h5>
                                <p class="card-text">
                                    Provides real-time, remote support through video conferencing and communication tools.
                                    Offers live assistance for tasks like meetings, presentations, customer service, and
                                    more, ensuring a professional presence without being physically on-site.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div
                            class="card h-100 text-center d-flex flex-column align-items-center justify-content-center p-2">
                            <img src="{{ asset('images/home-icons/receptionist.png') }}" class="card-img-top mt-3"
                                alt="...">

                            <div class="card-body">
                                <h5 class="card-title">Virtual Medical Receptionist</h5>
                                <p class="card-text">Efficiently manages patient appointments, phone calls, and medical
                                    records, allowing healthcare providers to focus on patient care while maintaining a
                                    smooth and professional front office.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <div class="col">
                        <div
                            class="card h-100 text-center d-flex flex-column align-items-center justify-content-center p-2">
                            <img src="{{ asset('images/home-icons/healthcare.png') }}" class="card-img-top mt-3"
                                alt="...">

                            <div class="card-body">
                                <h5 class="card-title">Healthcare Virtual Assistant</h5>
                                <p class="card-text">We assist with managing tasks like appointment scheduling, patient
                                    communication, billing, and insurance coordination, allowing healthcare professionals to
                                    focus on patient care.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div
                            class="card h-100 text-center d-flex flex-column align-items-center justify-content-center p-2">
                            <img src="{{ asset('images/home-icons/vet.png') }}" class="card-img-top mt-3" alt="...">

                            <div class="card-body">
                                <h5 class="card-title">Veterinary Virtual Assistants</h5>
                                <p class="card-text">
                                    We handle tasks such as appointment scheduling, client communication, billing, and
                                    insurance coordination, allowing veterinary professionals to focus on animal care.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-2">
                        <div
                            class="card h-100 text-center d-flex flex-column align-items-center justify-content-center p-2">
                            <img src="{{ asset('images/home-icons/transcription.png') }}" class="card-img-top mt-3"
                                alt="...">

                            <div class="card-body">
                                <h5 class="card-title">Medical Transcription</h5>
                                <p class="card-text">
                                    We provide medical transcription services, accurately converting spoken medical notes
                                    into written records, allowing healthcare professionals to focus on patient care.</p>
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
