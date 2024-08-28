@extends('staff.staffLayout')

@section('title', 'Inquiries')

@section('styles-links')

@endsection

@section('sidebar')
    <li class="nav-item">
        <a class="nav-link" href="/staff/patientRecord"><i class="fa-solid fa-clipboard me-2"></i> Patient Record</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/staff/derm"><i class="fa-solid fa-notes-medical me-2"></i> Derm</a>
    </li>
    <li class="nav-item">
        <a class="nav-link side-active" href="/staff/inquiry"><i class="fa-solid fa-magnifying-glass-arrow-right me-2"></i>
            Inquiry</a>
    </li>
@endsection

@section('main-content')
    <div class="container pt-5 d-flex flex-column gap-5">
        <div class="d-flex flex-column">

            <div class="table-responsive text-center p-3 bg-light position-relative">
                <div class="position-absolute top-0 start-0 p-3">
                    <a href="{{ route('staff.inquiry') }}">
                        <i class="fa-solid fa-circle-left fs-2 back"></i>
                    </a>
                </div>
                
                <form action="{{ route('staff.inquiryRespondStore', $inquiry->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <h3 class="mb-3"><i class="fa-solid fa-reply me-2"></i> Respond to {{ $inquiry->username }}'s inquiry
                    </h3>


                    {{-- <div class="mb-3 form-floating">
                        <input type="text" name="derm" class="form-control" id="derm" placeholder="">
                        <label for="derm" class="form-label">Patient Name</label>
                    </div> --}}
                    <div class="mb-3 d-flex flex-column align-items-start">
                        <label for="patient_name" class="form-label">Patient Name</label>
                        <input type="text" name="patient_name" class="form-control" id="patient_name"
                            placeholder="e.g. John Doe" value="{{ $inquiry->patient_name }}" readonly>
                    </div>

                    <div class="mb-3 d-flex flex-column align-items-start">
                        <label for="inquiry" class="form-label">Inquiry Details:</label>
                        <textarea name="inquiry" id="inquiry" class="form-control" readonly>{{ $inquiry->inquiry }}</textarea>
                    </div>

                    <div class="mb-3 d-flex flex-column align-items-start">
                        <label for="response" class="form-label">Respond:</label>
                        <textarea name="response" id="response" cols="30" rows="5" class="form-control"
                            placeholder="Type your response here..." required></textarea>
                    </div>

                    <div class="mb-3 d-flex flex-column align-items-start">
                        <label for="response_file" class="form-label">Attach a file:</label>
                        <input required type="file" name="response_file" class="form-control" id="response_file"
                               {{-- accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"> --}}
                               >
                    </div>

                    <div class="d-grid my-3">
                        <button class="btn btn-primary" type="submit">Submit Inquiry</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
@endsection
