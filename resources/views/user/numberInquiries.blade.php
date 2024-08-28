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

            <div class="table-responsive text-center p-3 bg-light" id="staffTable">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0"><i class="fa-solid fa-magnifying-glass-chart me-2"></i> Number of Inquiries</h5>

                    <div class="d-flex gap-4">
                        <form action="" class="d-flex">
                            <input type="search" class="form-control-custom rounded-start-custom"
                                placeholder="Search something...">
                            <button class="btn-custom dark-blue rounded-end-custom" type="submit"><i
                                    class="fa-solid fa-magnifying-glass"></i></button>
                        </form>

                    </div>
                </div>

                @php
                    // Get the current page number and items per page
                    $currentPage = $inquiries->currentPage();
                    $perPage = $inquiries->perPage();
                @endphp

                <table class="table table-bordered table-blue table-info rounded">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Patient Name</th>
                            <th>Inquiry Details</th>
                            <th>Inquiry History</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @forelse ($inquiries as $user) --}}
                        @forelse ($inquiries as $index => $inquiry)
                            <tr class="table-light light-border" style="border: 1px solid #03346E">
                                <td>{{ ($currentPage - 1) * $perPage + $index + 1 }}</td>
                                <td>{{ $inquiry->patient_name }}</td>
                                <td>{{ $inquiry->inquiry }}</td>
                                <td class="align-middle"><a href="{{ route('user.numberInquiriesHistory', $inquiry->id) }}"><i class="me-2 fa-solid fa-eye pointer" style="color: #0d6efd;" title="View your inquiry history."></i></a></td>
                                <td style="width: 20%">{{ \Carbon\Carbon::parse($inquiry->date)->format('F j, Y') }}</td>
                                {{-- Format date --}}
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
