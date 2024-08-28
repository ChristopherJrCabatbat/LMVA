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

            <div class="table-responsive text-center p-3 bg-light position-relative">
                <div class="position-absolute top-0 start-0 p-3">
                    <a href="{{ route('user.dashboard') }}">
                        <i class="fa-solid fa-circle-left fs-2 back"></i>
                    </a>
                </div>
                <form action="{{ route('staff.inquiryRespondStore', $inquiry->id) }}" method="POST">
                    @csrf
                    <h3 class="mb-3"><i class="fa-solid fa-reply me-2"></i> Staff's response to your inquiry</h3>
                
                    <div class="mb-3 d-flex flex-column align-items-start">
                        <label for="patient_name" class="form-label">Patient Name</label>
                        <input type="text" name="patient_name" class="form-control" id="patient_name"
                               placeholder="e.g. John Doe" value="{{ $inquiry->patient_name }}" readonly>
                    </div>
                
                    <div class="mb-3 d-flex flex-column align-items-start">
                        <label for="inquiry" class="form-label">Inquiry Details:</label>
                        <textarea name="inquiry" id="inquiry" cols="30" rows="5" class="form-control" readonly>{{ $inquiry->inquiry }}</textarea>
                    </div>
                
                    <div class="mb-3 d-flex flex-column align-items-start">
                        <label for="response" class="form-label">Response:</label>
                        <textarea name="response" id="response" cols="30" rows="5" class="form-control" readonly>{{ $inquiry->response }}</textarea>
                    </div>
                
                    <div class="mb-3 d-flex flex-column align-items-start">
                        <label for="response_file" class="form-label">Attached file:</label>
                        @if($inquiry->response_file)
                            <a href="{{ asset('storage/' . $inquiry->response_file) }}" class="view-file rounded p-2 px-3" title="This will open the file to a new tab." target="_blank">{{ basename($inquiry->original_file_name) }}</a>
                        @else
                            <p>No file attached.</p>
                        @endif
                    </div>
                
                    {{-- <div class="d-grid my-3">
                        <button class="btn btn-primary" type="submit">Submit Inquiry</button>
                    </div> --}}
                </form>
                
            </div>

        </div>
    </div>
@endsection

@section('scripts')
@endsection
