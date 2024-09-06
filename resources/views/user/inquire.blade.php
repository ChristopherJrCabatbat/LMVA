@extends('user.userLayout')

@section('title', 'Inquire')

@section('styles-links')

@endsection

@section('sidebar')
    <li class="nav-item">
        <a class="nav-link" href="/user/dashboard"><i class="fa-solid fa-gauge me-2"></i> Dashboard</a>
    </li>
    {{-- <hr /> --}}

    <li class="nav-item">
        <a class="nav-link side-active" href="#"><i class="me-2 fa-solid fa-magnifying-glass-arrow-right"></i>
            Inquire</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/user/numberInquiries"><i class="me-2 fa-solid fa-magnifying-glass-chart"></i> Number of
            Inquiries</a>
    </li>


@endsection

@section('main-content')
    <div class="container pt-5 d-flex flex-column gap-5">
        <div class="d-flex flex-column">

            <div class="table-responsive text-center p-3 bg-light">
                <form action="{{ route('user.inquireStore') }}" method="POST">
                    @csrf
                    <h3 class="mb-3"><i class="fa-solid fa-magnifying-glass-arrow-right me-2"></i> Inquire</h3>

                    {{-- <div class="mb-3 form-floating">
                        <input type="text" name="derm" class="form-control" id="derm" placeholder="">
                        <label for="derm" class="form-label">Patient Name</label>
                    </div> --}}
                    <div class="mb-3 d-flex flex-column align-items-start">
                        <label for="patient_name" class="form-label">Patient Name:</label>
                        <input type="text" name="patient_name" class="form-control" id="patient_name" placeholder="e.g. John Doe" required>
                    </div>

                    <div class="mb-3 d-flex flex-column align-items-start">
                        <label for="inquiry" class="form-label">Inquiry Details:</label>
                        <textarea name="inquiry" id="inquiry" cols="30" rows="5" class="form-control" placeholder="Type something here..." required></textarea>
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
