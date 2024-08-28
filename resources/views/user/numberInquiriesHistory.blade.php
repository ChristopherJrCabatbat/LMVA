@extends('user.userLayout')

@section('title', 'Number of Inquiries')

@section('styles-links')

@endsection

@section('sidebar')
    <li class="nav-item">
        <a class="nav-link" href="/user/dashboard"><i class="fa-solid fa-gauge me-2"></i> Dashboard</a>
    </li>
    {{-- <hr /> --}}

    <li class="nav-item">
        <a class="nav-link" href="/user/inquire"><i class="me-2 fa-solid fa-magnifying-glass-arrow-right"></i>
            Inquire</a>
    </li>

    <li class="nav-item">
        <a class="nav-link side-active" href="/user/numberInquiries"><i class="me-2 fa-solid fa-magnifying-glass-chart"></i>
            Number of
            Inquiries</a>
    </li>


@endsection

@section('main-content')
    <div class="container pt-5 d-flex flex-column gap-5">
        <div class="d-flex flex-column">

            <div class="table-responsive p-4 bg-light mx-auto position-relative">
                <div class="position-absolute top-0 start-0 p-4">
                    <a href="{{ route('user.numberInquiries') }}">
                        <i class="fa-solid fa-circle-left fs-2 back"></i>
                    </a>
                </div>
                <h3 class="mb-4 text-center"><i class="fa-solid fa-database me-2"></i> Inquiry History</h3>
            
                <div class="row justify-content-center">
                    <!-- Left Column -->
                    <div class="col-md-6">
                        <!-- Username -->
                        <div class="mb-3 d-flex flex-column align-items-start">
                            <label class="form-label fw-bold">Username:</label>
                            <p class="form-control-plaintext">{{ $inquiry->username }}</p>
                        </div>
            
                        <!-- Contact Number -->
                        <div class="mb-3 d-flex flex-column align-items-start">
                            <label class="form-label fw-bold">Contact Number:</label>
                            <p class="form-control-plaintext">{{ $inquiry->contact_number }}</p>
                        </div>
            
                        <!-- Email -->
                        <div class="mb-3 d-flex flex-column align-items-start">
                            <label class="form-label fw-bold">Email:</label>
                            <p class="form-control-plaintext">{{ $inquiry->email }}</p>
                        </div>
            
                        <!-- Date -->
                        <div class="mb-3 d-flex flex-column align-items-start">
                            <label class="form-label fw-bold">Date:</label>
                            <p class="form-control-plaintext">{{ \Carbon\Carbon::parse($inquiry->date)->format('F j, Y') }}</p>
                        </div>
                    </div>
            
                    <!-- Right Column -->
                    <div class="col-md-6">
                        <!-- Payment Method -->
                        <div class="mb-3 d-flex flex-column align-items-start">
                            <label class="form-label fw-bold">Payment Method:</label>
                            <p class="form-control-plaintext">{{ $inquiry->payment_method ?? '--' }}</p>
                        </div>
            
                        <!-- Patient Name -->
                        <div class="mb-3 d-flex flex-column align-items-start">
                            <label class="form-label fw-bold">Patient Name:</label>
                            <p class="form-control-plaintext">{{ $inquiry->patient_name }}</p>
                        </div>
            
                        <!-- Attached File -->
                        <div class="mb-3 d-flex flex-column align-items-start">
                            <label class="form-label fw-bold">Attached File:</label>
                            @if ($inquiry->response_file)
                                <a href="{{ asset('storage/' . $inquiry->response_file) }}" class="view-file rounded p-2 px-3"
                                   title="This will open the file in a new tab." target="_blank">
                                   {{ basename($inquiry->original_file_name) }}
                                </a>
                            @else
                                <p class="form-control-plaintext">No file attached.</p>
                            @endif
                        </div>
                    </div>
                </div>
            
                <!-- Full-Width Row for Inquiry Details -->
                <div class="row mt-2">
                    <div class="col-12">
                        <div class="mb-3 d-flex flex-column align-items-start">
                            <label class="form-label fw-bold">Inquiry Details:</label>
                            <p class="form-control-plaintext">{{ $inquiry->inquiry }}</p>
                        </div>
                    </div>
                </div>
            
                <!-- Full-Width Row for Response -->
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3 d-flex flex-column align-items-start">
                            <label class="form-label fw-bold">Response:</label>
                            <p class="form-control-plaintext">{{ $inquiry->response ?? 'No response yet.' }}</p>
                        </div>
                    </div>
                </div>
            </div>           

        </div>
    </div>
@endsection

@section('scripts')
@endsection
