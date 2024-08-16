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
            <h1 class="h1">Staff Dashboard</h1>
            {{-- <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-primary"><i
                        class="me-2 fa-solid fa-arrow-right-from-bracket rotate"></i>
                    {{ __('Log Out') }}</button>
            </form> --}}
        </div>
    </main>

    <footer></footer>

    @yield('scripts')

    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.js') }}"></script>
    

</body>

</html>
