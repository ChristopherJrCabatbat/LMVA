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

    <header></header>

    <main>
        <h1 class="h1">Admin Dashboard</h1>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-primary"><i
                    class="me-2 fa-solid fa-arrow-right-from-bracket rotate"></i>
                {{ __('Log Out') }}</button>
        </form>
    </main>

    <footer></footer>

    @yield('scripts')

    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.js') }}"></script>

</body>

</html>
