    @extends('user.userLayout')

    @section('title', 'User Dashboard')

    @section('styles-links')

    @endsection

    @section('sidebar')
        <li class="nav-item">
            <a class="nav-link side-active" href="#"><i class="fa-solid fa-gauge me-2"></i> Dashboard</a>
        </li>
        <hr />

        <li class="nav-item">
            <a class="nav-link" href="/user/inquire"><i class="me-2 fa-solid fa-magnifying-glass-arrow-right"></i> Inquire</a>
        </li>

        {{-- <hr /> --}}
        <li class="nav-item">
            <a class="nav-link" href="/user/numberInquiries"><i class="me-2 fa-solid fa-magnifying-glass-chart"></i> Number
                of Inquiries</a>
        </li>

    @endsection

    @section('main-content')
        <div class="container pt-5">
            <h1 class="h1">User Dashboard</h1>
        </div>
    @endsection

    @section('scripts')
    @endsection
