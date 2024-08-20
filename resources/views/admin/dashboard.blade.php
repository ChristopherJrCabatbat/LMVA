@extends('admin.adminLayout')

@section('title', 'Admin Dashboard')

@section('styles-links')
@endsection

@section('sidebar')
    <li class="nav-item">
        <a class="nav-link side-active" href="#"><i class="fa-solid fa-gauge me-2"></i> Dashboard</a>
    </li>
    <hr />
    <li class="nav-item">
        <a class="nav-link" href="/admin/accounts"><i class="fa-solid fa-users me-2"></i> Accounts</a>
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

            <div class="table-responsive text-center p-3 bg-light" id="staffTable">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0"><i class="fa-solid fa-laptop-medical me-2"></i> Patient Records</h5>

                    <div class="d-flex gap-4">
                        <form action="dashboardAdd">
                            <button class="btn add" type="submit"><i class="fas fa-plus"></i> Add Record</button>
                        </form>
                        <form action="" class="d-flex">
                            <input type="search" class="form-control-custom rounded-start-custom">
                            <button class="btn-custom add rounded-end-custom" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>

                    </div>
                </div>

                <table class="table table-bordered bg-dark rounded" data-bs-theme="dark">
                    <thead>
                        <tr>
                            <th scope="col">File Name</th>
                            <th scope="col">File</th>
                            {{-- <th scope="col">Print</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($staffs as $staff)
                            <tr class="table-light" style="border: 1px solid #03346E">
                                <td>{{ $staff->username }}</td>
                                <td>{{ $staff->first_name }}</td>
                                {{-- <td>
                                    <a href="" class="print" style="color: #002046;"><i
                                            class="fa-solid fa-print fs-3"></i></a>
                                </td> --}}
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
