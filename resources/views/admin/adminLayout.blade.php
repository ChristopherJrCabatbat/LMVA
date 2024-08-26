<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/lmva-icon.png') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin-styles.css') }}">

    @yield('styles-links')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/f416851b63.js" crossorigin="anonymous"></script>

</head>

<body style="background-color: rgb(218, 218, 218)">
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                alert('{{ session('success') }}');
            });
        </script>
    @endif

    @if (session('error'))
        <div class="alert alert-danger" id="error-alert">
            <i class="fa-solid fa-triangle-exclamation"></i> {{ session('error') }}
        </div>
    @endif

    @yield('modals')

    <header>
        {{-- Top Navbar --}}
        <nav class="navbar fixed-top navbar-expand-lg p-0 bg-dark" data-bs-theme="dark"
            style="border-bottom: 1px solid #03346E;">
            <div class="container">
                <a class="navbar-brand logo" href="#">
                    <img src="{{ asset('images/lmva-logo.png') }}" class="img-fluid" style="width: 110px; height: 100%"
                        alt="User Image" />
                </a>
                <div id="">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        @if (Auth::check())
                            <li class="nav-item dropdown" style="position: relative;">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-user"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown"
                                    style="position: absolute; top: 100%; left: 0; right: 0; margin-top: 0; z-index: 1000;  ">
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
                        @endif
                    </ul>
                </div>
            </div>
        </nav>


        {{-- Side Navbar --}}
        <div class="sidebar bg-dark text-white" data-bs-theme="dark">
            <div class="user-info">
                <div class="username text-white">Hello, {{ Auth::user()->first_name }}!</div>
                <div class="position">You are logged in as {{ Auth::user()->role }}.</div>
            </div>
            <hr />

            <ul class="nav flex-column text-white">
                @yield('sidebar')
            </ul>
        </div>
    </header>

    <main class="main-content">
        @yield('main-content')
    </main>

    <footer></footer>

    @yield('scripts')

    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Automatically close the alert after 5 seconds
            setTimeout(function() {
                const errorAlert = document.getElementById('error-alert');
                if (errorAlert) {
                    errorAlert.style.transition = 'opacity 0.5s ease';
                    errorAlert.style.opacity = '0';
                    setTimeout(function() {
                        errorAlert.remove();
                    }, 500); // Wait for the transition to complete before removing
                }
            }, 5000); // 5 seconds
        });
    </script>

</body>

</html>
