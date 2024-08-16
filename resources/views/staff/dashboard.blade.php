@extends('staff.staffLayout')

@section('title', 'Staff Dashboard')

@section('styles-links')

@endsection

@section('sidebar')
    <li class="nav-item">
        <a class="nav-link side-active" href="content_dashboard"><i class="fa-solid fa-gauge me-2"></i> Dashboard</a>
    </li>
    <hr />
    <li class="nav-item">
        <a class="nav-link" href="content_dashboard"><i class="fa-solid fa-gauge me-2"></i> Accounts</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="content_dashboard"><i class="fa-solid fa-gauge me-2"></i> DERM</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="content_dashboard"><i class="fa-solid fa-gauge me-2"></i> Reports</a>
    </li>

@endsection

@section('main-content')
@endsection

@section('scripts')
@endsection
