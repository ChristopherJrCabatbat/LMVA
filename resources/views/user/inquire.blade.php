@extends('user.userLayout')

@section('title', 'User Dashboard')

@section('styles-links')

@endsection

@section('sidebar')
    <li class="nav-item">
        <a class="nav-link" href="/user/dashboard"><i class="fa-solid fa-gauge me-2"></i> Dashboard</a>
    </li>
    <hr />

    <li class="nav-item">
        <a class="nav-link side-active" href="/user/inquire"><i class="me-2 fa-solid fa-user"></i> Inquire</a>
    </li>

    {{-- <hr /> --}}
    <li class="nav-item">
        <a class="nav-link" href="attendance"><i class="me-2 fa-solid fa-clipboard-user"></i> Number of Inquiries</a>
    </li>

    {{-- <li class="nav-item">
        <a class="nav-link" href="leave"><i class="me-2 fa-solid fa-arrow-right-from-bracket"></i> Leave</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/manager/department/create"><i class="me-2 fa-solid fa-plus"></i> New Department</a>
    </li>
    <li class="nav-item">
        <hr />
    </li>
    <li class="nav-item">
        <a class="nav-link" href="recruitment-dashboard"><i class="me-2 fa-solid fa-database"></i> Recruitment</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="payroll"><i class="me-2 fa-solid fa-dollar-sign"></i> Payroll</a>
    </li> --}}

@endsection

@section('main-content')
@endsection

@section('scripts')
@endsection
