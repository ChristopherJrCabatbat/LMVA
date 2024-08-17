@extends('staff.staffLayout')

@section('title', 'Patient Record')

@section('styles-links')

@endsection

@section('sidebar')
    <li class="nav-item">
        <a class="nav-link side-active" href="#"><i class="fa-solid fa-clipboard me-2"></i> Patient Record</a>
    </li>
    <hr />
    <li class="nav-item">
        <a class="nav-link" href="/staff/scan"><i class="fa-solid fa-qrcode me-2"></i> Scan</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/staff/inquiry"><i class="fa-solid fa-magnifying-glass-arrow-right me-2"></i>
            Inquiry</a>
    </li>
@endsection

@section('main-content')
    <div class="container pt-5">
        <h1 class="h1">Staff Inquiry</h1>
    </div>
@endsection

@section('scripts')
@endsection
