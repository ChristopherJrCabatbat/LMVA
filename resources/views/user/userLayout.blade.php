<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    @yield('styles-links')

    <script src="https://kit.fontawesome.com/f416851b63.js" crossorigin="anonymous"></script>
</head>

<style>
    main {
        background-size: cover;
        background-position: center;
        min-height: 100vh;
        /* padding-top: 60px; */
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
       {{-- Top Navbar --}}
<nav class="navbar fixed-top navbar-expand-lg p-0" style="background-color: white; border-bottom: 1px solid #dee2e6;">
    <div class="container">
        <a class="navbar-brand logo" href="#">
            <img src="{{ asset('images/lmva-logo.png') }}" class="img-fluid" style="width: 110px; height: 100%" alt="User Image" />
        </a>
        <div id="">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                @if (Auth::check())
                    <li class="nav-item dropdown" style="position: relative;">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-user"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="position: absolute; top: 100%; left: 0; right: 0; margin-top: 0; z-index: 1000;">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="me-2 fa-solid fa-user"></i> Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="me-2 fa-solid fa-arrow-right-from-bracket rotate"></i>
                                        {{ __('Log Out') }}</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>


        {{-- Side Navbar --}}
         <div class="sidebar">
            <div class="user-info">
                <div class="username">Hello, {{ Auth::user()->first_name }}!</div>
                <div class="position">You are logged in as {{ Auth::user()->role }}.</div>
                {{-- <div class="position">{{ Auth::user()->role }}</div> --}}
            </div>

            <ul class="nav flex-column">
                @yield('sidebar')
            </ul>
        </div>
    </header>

    <main class="main-content">
        <div class="container pt-5">
            <h1 class="h1">User Dashboard</h1>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-primary"><i
                        class="me-2 fa-solid fa-arrow-right-from-bracket rotate"></i>
                    {{ __('Log Out') }}</button>
            </form>
        </div>
    </main>

    {{-- <footer class="pt-4" style="background-color: white;">
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
            <span class="copyright-color text-body-secondary"><i class="fa-regular fa-copyright"></i> Copyright</span> LMVA Company
        </div>
    </footer> --}}

    <footer></footer>

    @yield('scripts')

    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.js') }}"></script>
    

</body>

</html>
