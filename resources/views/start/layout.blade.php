<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/lmva-icon.jpg') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <script src="https://kit.fontawesome.com/f416851b63.js" crossorigin="anonymous"></script>
</head>

<style>
    .nav-link {
        font-size: 1.15rem;
        margin-right: 40px;
    }

    main {
        background-size: cover;
        /* This already ensures the image covers the entire background */
        background-position: center;
        background-repeat: no-repeat;
        /* Ensures the image doesn't repeat */
        background-attachment: fixed;
        /* Makes the background image fixed when scrolling */
        min-height: 94vh;
        padding-top: 10.2vh;
        margin-top: 1rem;
        animation: slideshow 15s infinite;
    }

    @keyframes slideshow {
        0% {
            background-image: url("{{ asset('images/lmvapic1.jpg') }}");
        }

        35% {
            background-image: url("{{ asset('images/lmvapic2.jpg') }}");
        }

        75% {
            background-image: url("{{ asset('images/lmvapic3.jpg') }}");
        }

        100% {
            background-image: url("{{ asset('images/lmvapic1.jpg') }}");
        }
    }
</style>

@yield('styles-links')


<body>
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                alert('{{ session('success') }}');
            });
        </script>
    @endif
    {{-- @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif --}}

    <header>
        <nav class="navbar fixed-top navbar-expand-lg p-0" {{-- style="background-color: #e3f2fd;" --}} style="background-color: white;">
            <div class="container">
                <a class="navbar-brand logo" href="#">
                    <img src="{{ asset('images/lmva-logo.png') }}" class="img-fluid" style="width: 110px; height: 100%"
                        alt="Logo" />
                </a>
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        @yield('nav-links')
                        {{-- @if (Auth::check())
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ Auth::user()->photo ? asset(Auth::user()->photo) : asset('images/employee.png') }}"
                                        alt="User Image" class="rounded-circle" style="width: 30px; height: 30px;">
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i
                                                class="me-2 fa-solid fa-user"></i> Profile</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item"><i
                                                    class="me-2 fa-solid fa-arrow-right-from-bracket rotate"></i>
                                                {{ __('Log Out') }}</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif --}}
                    </ul>
                </div>

            </div>
        </nav>
    </header>

    <main>
        @yield('main-content')
    </main>

    <footer class="pt-4" style="background-color: white;">
        <div class="container">
            <div class="container text-center">
                <div class="row row-cols-4">
                    <div class="col d-flex flex-column">
                        <div class="footer-header-links fw-bold fs-5 mb-2">DISCOVER</div>
                        <div class="container-footer-links">
                            <div class="footer-links">Accomodations</div>
                            <div class="footer-links">Services</div>
                            <div class="footer-links">Activities</div>
                        </div>
                    </div>
                    <div class="col d-flex flex-column">
                        <div class="footer-header-links fw-bold fs-5 mb-2">BOOK</div>
                        <div class="container-footer-links">
                            <div class="footer-links">Reservations</div>
                            <div class="footer-links">Specials & Packages</div>
                        </div>
                    </div>
                    <div class="col d-flex flex-column">
                        <div class="footer-header-links fw-bold fs-5 mb-2">STAY</div>
                        <div class="container-footer-links">
                            <div class="footer-links">Guidelines</div>
                            <div class="footer-links">Contact us</div>
                            <div class="footer-links">FAQ</div>
                        </div>
                    </div>
                    <div class="col d-flex flex-column">
                        <div class="footer-header-links fw-bold fs-5 mb-2">LOCATION</div>
                        <div class="container-footer-links">
                            <div class="footer-links">Novaliches, Quezon City, Metro Manila</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container px-5 mt-4">
                <div class="border-top border-2 mx-auto pt-4 text-center" style="width: 80%;">
                    <div class="footer-paragraph">
                        At LMVA, we're dedicated to providing seamless medical assistance services. If you have any
                        inquiries or require assistance, our customer support team is available around the clock to
                        help. We value your trust in us and eagerly anticipate serving you. Thank you for choosing LMVA.
                    </div>
                    <div class="socials d-flex justify-content-center mt-3">
                        <i class="fa-brands fa-facebook mx-2"></i>
                        <i class="fa-brands fa-twitter mx-2"></i>
                        <i class="fa-brands fa-google-plus-g mx-2"></i>
                        <i class="fa-brands fa-linkedin mx-2"></i>
                        <i class="fa-brands fa-instagram mx-2"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright text-center p-2 mt-4 sticky-bottom" style="background-color: #d6d6d6;">
            <span class="copyright-color text-body-secondary"><i class="fa-regular fa-copyright"></i> Copyright</span>
            LMVA Company
        </div>
    </footer>

    @yield('scripts')

    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.js') }}"></script>

</body>

</html>
