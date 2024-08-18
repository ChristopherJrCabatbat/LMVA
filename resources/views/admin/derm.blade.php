@extends('admin.adminLayout')

@section('title', 'Admin DERM')

@section('styles-links')

    <style>
        .sidebar {
            border-right: 1px solid #03346E;
        }

        .sidebar .nav-item .nav-link {
            color: white;
        }

        .sidebar .nav-item .nav-link:hover {
            background-color: #03346E;
        }

        .sidebar .nav-item .nav-link.side-active:hover {
            background-color: #0d6efd;
        }
    </style>

@endsection

@section('sidebar')
    <li class="nav-item">
        <a class="nav-link" href="/admin/dashboard"><i class="fa-solid fa-gauge me-2"></i> Dashboard</a>
    </li>
    <hr />
    <li class="nav-item">
        <a class="nav-link" href="/admin/accounts"><i class="fa-solid fa-users me-2"></i> Accounts</a>
    </li>
    <li class="nav-item">
        <a class="nav-link side-active" href="#"><i class="fa-solid fa-notes-medical me-2"></i> DERM</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/admin/reports"><i class="fa-solid fa-newspaper me-2"></i> Reports</a>
    </li>

@endsection

@section('main-content')
    <div class="container pt-5">
        <h1 class="h1">Admin Derms</h1>
    </div>
@endsection

@section('scripts')
@endsection
