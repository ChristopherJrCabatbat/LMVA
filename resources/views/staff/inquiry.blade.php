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
        <a class="nav-link side-active" href="#"><i class="fa-solid fa-magnifying-glass-arrow-right me-2"></i>
            Inquiry</a>
    </li>
@endsection

@section('main-content')
    <div class="container pt-5 d-flex flex-column gap-5">
        <div class="d-flex flex-column">

            <div class="table-responsive text-center p-3 bg-light" id="staffTable">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0"><i class="fa-solid fa-magnifying-glass-arrow-right me-2"></i> Inquiries</h5>

                    <div class="d-flex gap-4">
                        <form action="" class="d-flex">
                            <input type="search" class="form-control-custom rounded-start-custom"
                                placeholder="Search something...">
                            <button class="btn-custom dark-blue rounded-end-custom" type="submit"><i
                                    class="fa-solid fa-magnifying-glass"></i></button>
                        </form>

                    </div>
                </div>

                <table class="table table-bordered table-blue table-info rounded">
                    <thead>
                        <tr>
                            <th scope="col">Email</th>
                            <th scope="col">Contact Number</th>
                            <th scope="col">Inquiry Details</th>
                            <th scope="col">Payment Method</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($inquiries as $inquiry)
                            <tr class="table-light light-border" style="border: 1px solid #03346E">
                                <td>{{ $inquiry->email }}</td>
                                <td>{{ $inquiry->contact_number }}</td>
                                <td>{{ $inquiry->inquiry }}</td>
                                <td>{{ $inquiry->payment_method ?? '--' }}</td>
                                <td><a href="{{ route('staff.inquiryRespond', $inquiry->id) }}" class="pointer respond">Respond</a></td>
                            </tr>
                        @empty
                            <tr class="table-light">
                                <td colspan="6" class="text-center">There are no inquiries.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Include the Pagination Component -->
                @include('components.staff-userPagination', ['items' => $inquiries])

            </div>

        </div>
    </div>
@endsection

@section('scripts')
@endsection
