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
        padding-top: 60px;
        animation: slideshow 15s infinite;
        /* 15 seconds for the full cycle */
    }

    /* main {
        position: relative;
        background-size: cover;
        background-position: center;
        min-height: 100vh;
        padding-top: 60px;
        animation: slideshow 12s infinite;
        background-image: linear-gradient(rgba(0, 0, 0, 0.6),
                rgba(0, 0, 0, 0.6)), url("{{ asset('images/lmvapic2.jpg') }}");
    }

    main>.container {
        position: relative;
        z-index: 2;
        color: white;
    } */

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
        <nav class="navbar fixed-top navbar-expand-lg" style="background-color: #e3f2fd;">
            <div class="container">
                <a class="navbar-brand mb-0 h1 fs-2 logo" href="/manager/content_dashboard">
                    <img src="{{ asset('images/lmva-logo.png') }}" class="img-fluid" style="width: 120px; height: 100%"
                        alt="User Image" />
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <a class="nav-link nav-letterSpacing active" aria-current="page" href="#">HOME</a>
                        <a class="nav-link nav-letterSpacing" href="#">CONTACT</a>
                        <a class="nav-link nav-letterSpacing" href="#">LOGIN</a>
                        <a class="nav-link nav-letterSpacing" href="#">REGISTER</a>
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

    <main class="mt-5">
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

    <footer></footer>

    @yield('scripts')

    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.js') }}"></script>

</body>

</html>
