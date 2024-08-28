@extends('admin.adminLayout')

@section('title', 'View Account')

@section('styles-links')
@endsection

@section('modals')
@endsection

@section('sidebar')
    <li class="nav-item">
        <a class="nav-link" href="/admin/dashboard"><i class="fa-solid fa-gauge me-2"></i> Dashboard</a>
    </li>
    <li class="nav-item">
        <a class="nav-link side-active" href="#"><i class="fa-solid fa-users me-2"></i> Accounts</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/admin/derm"><i class="fa-solid fa-notes-medical me-2"></i> DERM</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/admin/reports"><i class="fa-solid fa-newspaper me-2"></i> Reports</a>
    </li>

@endsection

@section('main-content')
    <div class="container pt-5 d-flex flex-column gap-5">
        <div class="d-flex flex-column">

            <div class="table-responsive p-4 bg-light mx-auto position-relative">
                <div class="position-absolute top-0 start-0 p-4">
                    <a href="{{ route('admin.accounts') }}">
                        <i class="fa-solid fa-circle-left fs-2 back"></i>
                    </a>
                </div>
                <h3 class="mb-4 text-center"><i class="fa-solid fa-eye me-2"></i> View Staff Account</h3>

                <div class="row justify-content-center">
                    <!-- Left Column -->
                    <div class="col-md-6">
                        <!-- Username -->
                        <div class="mb-3 d-flex flex-column align-items-start">
                            <label class="form-label fw-bold">Username:</label>
                            <p class="form-control-plaintext">{{ $users->username }}</p>
                        </div>

                        <!-- Name -->
                        <div class="mb-3 d-flex flex-column align-items-start">
                            <label class="form-label fw-bold">Name:</label>
                            <p class="form-control-plaintext">{{ $users->first_name }} {{ $users->last_name }}</p>
                        </div>

                    </div>

                    <!-- Right Column -->
                    <div class="col-md-6">
                        <!-- Email -->
                        <div class="mb-3 d-flex flex-column align-items-start">
                            <label class="form-label fw-bold">Email:</label>
                            <p class="form-control-plaintext">{{ $users->email }}</p>
                        </div>

                        <!-- Payment Method -->
                        <div class="mb-3 d-flex flex-column align-items-start">
                            <label class="form-label fw-bold">Contact Number:</label>
                            <p class="form-control-plaintext">{{ $users->contact_number ?? '--' }}</p>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
@endsection
