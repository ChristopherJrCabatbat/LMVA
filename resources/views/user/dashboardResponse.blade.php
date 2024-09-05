@extends('user.userLayout')

@section('title', 'Dashboard')

@section('styles-links')

@endsection

@section('sidebar')
    <li class="nav-item">
        <a class="nav-link side-active" href="/user/dashboard"><i class="fa-solid fa-gauge me-2"></i> Dashboard</a>
    </li>
    {{-- <hr /> --}}

    <li class="nav-item">
        <a class="nav-link" href="/user/inquire"><i class="me-2 fa-solid fa-magnifying-glass-arrow-right"></i>
            Inquire</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/user/numberInquiries"><i class="me-2 fa-solid fa-magnifying-glass-chart"></i>
            Number of
            Inquiries</a>
    </li>

@endsection

@section('main-content')

    <div class="container pt-5 d-flex flex-column gap-5">
        <div class="d-flex flex-column">
            <div class="table-responsive p-4 bg-light mx-auto position-relative">
                <div class="position-absolute top-0 start-0 p-4">
                    <a href="{{ route('user.dashboard') }}">
                        <i class="fa-solid fa-circle-left fs-2 back"></i>
                    </a>
                </div>
                <form action="{{ route('staff.inquiryRespondStore', $inquiry->id) }}" method="POST">
                    @csrf
                    <h3 class="mb-4 text-center"><i class="fa-solid fa-reply me-2"></i> Staff's response to your inquiry
                    </h3>

                    <!-- Patient Name -->
                    <div class="mb-3 d-flex flex-column align-items-start">
                        <label for="patient_name" class="form-label">Patient Name:</label>
                        <p class="form-control-plaintext">{{ $inquiry->patient_name }}</p>
                    </div>

                    <!-- Attached File -->
                    <div class="mb-3 d-flex flex-column align-items-start">
                        <label for="response_file" class="form-label">Attached file:</label>
                        @if ($inquiry->response_file)
                            @php
                                $filePath = 'storage/' . $inquiry->response_file;
                                $fileExtension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
                                $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg', 'webp'];
                            @endphp

                            @if (in_array($fileExtension, $imageExtensions))
                                <!-- Display the image full screen -->
                                <img src="{{ asset($filePath) }}" alt="{{ basename($inquiry->original_file_name) }}"
                                    height="70" onclick="showQRCode('{{ asset($filePath) }}')" style="cursor: pointer;"
                                    title="Click to expand.">
                            @else
                                <a href="{{ asset($filePath) }}" class="view-file rounded p-2 px-3" target="_blank"
                                    title="This will open the file in a new tab.">
                                    {{ basename($inquiry->original_file_name) }}
                                </a>
                            @endif
                        @else
                            <p class="form-control-plaintext">No file attached.</p>
                        @endif
                    </div>

                    <!-- Full-Width Row for Inquiry Details and Response -->
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="mb-3 d-flex flex-column align-items-start">
                                <label for="inquiry" class="form-label">Inquiry Details:</label>
                                <p class="form-control-plaintext">{!! nl2br(e($inquiry->inquiry)) !!}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class=" d-flex flex-column align-items-start">
                                <label for="response" class="form-label">Response:</label>
                                <p class="form-control-plaintext">{!! nl2br(e($inquiry->response)) !!}</p>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>



@endsection

@section('scripts')
@endsection
