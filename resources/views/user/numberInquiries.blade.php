@extends('user.userLayout')

@section('title', 'User Inquire')

@section('styles-links')

@endsection

@section('sidebar')
    <li class="nav-item">
        <a class="nav-link" href="/user/dashboard"><i class="fa-solid fa-gauge me-2"></i> Dashboard</a>
    </li>
    <hr />

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
                    <h5 class="mb-0"><i class="fa-solid fa-notes-medical me-2"></i> Inquiries</h5>

                    <div class="d-flex gap-4">
                        {{-- <form action="dermAdd">
                            <button class="btn dark-blue" type="submit"><i class="fas fa-plus"></i> Inquire</button>
                        </form> --}}
                        <form action="" class="d-flex">
                            <input type="search" class="form-control-custom rounded-start-custom"
                                placeholder="Search something...">
                            <button class="btn-custom dark-blue rounded-end-custom" type="submit"><i
                                    class="fa-solid fa-magnifying-glass"></i></button>
                        </form>

                    </div>
                </div>

                <table class="table table-bordered bg-dark rounded" data-bs-theme="dark">
                    <thead>
                        <tr>
                            <th scope="col">DERM</th>
                            <th scope="col">QR Code</th>
                            <th scope="col">Print</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($staffs as $staff)
                            <tr class="table-light" style="border: 1px solid #03346E">
                                <td>{{ $staff->username }}</td>
                                <td>{{ $staff->first_name }}</td>
                                <td>
                                    <a href="" class="print" style="color: #002046;"><i
                                            class="fa-solid fa-print fs-3"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">There are no derm.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- Staff Pagination --}}
                {{-- <nav aria-label="Staff Pagination">
                <ul class="pagination justify-content-end">
                <!-- Add your pagination links here -->
                </ul>
            </nav> --}}
            </div>

        </div>
    </div>
@endsection

@section('scripts')
@endsection
