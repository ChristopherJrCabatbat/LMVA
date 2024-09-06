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

    <!-- Profile Edit Modal -->
    <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg"> <!-- Modal large to accommodate two columns -->
            <div class="p-2 modal-content">
                <div class="modal-header d-flex justify-content-between align-items-center">
                    <div class="w-100 d-flex align-items-center justify-content-center">
                        <i class="fas fa-pen-to-square fs-4 me-2"></i>
                        <h5 class="modal-title mb-0" id="profileModalLabel">Edit Profile</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <!-- Profile Edit Form -->
                    <form id="profileForm" action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- Left Column -->
                            <div class="col-md-6">
                                <!-- Username -->
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="username"
                                        value="{{ old('username', Auth::user()->username) }}" required>
                                    @error('username')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- First Name -->
                                <div class="mb-3">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name"
                                        value="{{ old('first_name', Auth::user()->first_name) }}" required>
                                    @error('first_name')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Contact Number -->
                                <div class="mb-3">
                                    <label for="contact_number" class="form-label">Contact Number</label>
                                    <input type="text" class="form-control" id="contact_number" name="contact_number"
                                        value="{{ old('contact_number', Auth::user()->contact_number) }}" required>
                                    @error('contact_number')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="col-md-6">
                                <!-- Email -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ old('email', Auth::user()->email) }}" required>
                                    @error('email')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Last Name -->
                                <div class="mb-3">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name"
                                        value="{{ old('last_name', Auth::user()->last_name) }}" required>
                                    @error('last_name')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Password and Confirm Password in the Bottom Row -->
                        <div class="row">
                            <!-- Password -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Leave blank to keep current password">
                                    @error('password')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Confirm Password -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="password_confirmation"
                                        name="password_confirmation"
                                        placeholder="Leave blank to keep current password">
                                </div>
                            </div>
                        </div>

                        <!-- Save Changes Button -->
                        <div class="d-grid mt-3">
                            <button type="submit" class="btn dark-blue">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <header>
        {{-- Top Navbar --}}
        <nav class="navbar fixed-top navbar-expand-lg p-0 bg-dark" data-bs-theme="dark"
            style="border-bottom: 1px solid #03346E;">
            <div class="container">
                <a class="navbar-brand logo" href="#">
                    <img src="{{ asset('images/lmva-logo.png') }}" class="img-fluid"
                        style="width: 110px; height: 100%" alt="User Image" />
                </a>
                <div id="">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        @if (Auth::check())
                            <li class="nav-item dropdown" style="position: relative;">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-user"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown"
                                    style="position: absolute; top: 100%; left: 0; right: 0; margin-top: 0; z-index: 1000;  ">
                                    <!-- Profile Dropdown Link -->
                                    <li class="profile-logout">
                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                            data-bs-target="#profileModal">
                                            <i class="me-2 fa-solid fa-user"></i> Profile
                                        </a>
                                    </li>
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

    {{-- Only admin files message automatic close --}}
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


    {{-- Contact Number --}}
    <script>
        document.getElementById('contact_number').addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/[^0-9+\-() ]/g, '');
        });
    </script>

    {{-- Profile Modal --}}
    <script>
        window.validationErrors = @json($errors->any());
    </script>

</body>

</html>
