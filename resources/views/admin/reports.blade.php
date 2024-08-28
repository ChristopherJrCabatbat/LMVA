@extends('admin.adminLayout')

@section('title', 'Admin Reports')

@section('styles-links')

@endsection

@section('sidebar')
    <li class="nav-item">
        <a class="nav-link" href="/admin/dashboard"><i class="fa-solid fa-gauge me-2"></i> Dashboard</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/admin/accounts"><i class="fa-solid fa-users me-2"></i> Accounts</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/admin/derm"><i class="fa-solid fa-notes-medical me-2"></i> DERM</a>
    </li>
    <li class="nav-item">
        <a class="nav-link side-active" href="#"><i class="fa-solid fa-newspaper me-2"></i> Reports</a>
    </li>

@endsection

@section('main-content')
    <div class="container pt-5 d-flex flex-column gap-5">
        <div class="d-flex flex-column">

            <div class="table-responsive text-center p-3 bg-light" id="staffTable">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0"><i class="fa-solid fa-notes-medical me-2"></i> Reports</h5>

                    <div class="d-flex gap-4">
                        {{-- <form action="dermAdd">
                        <button class="btn add" type="submit"><i class="fas fa-plus"></i> Add Report</button>
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
                            <th scope="col">Email</th>
                            <th scope="col">Contact Number</th>
                            <th scope="col">Inquiry Details</th>
                            <th scope="col">Payment Method</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr class="table-light light-border" style="border: 1px solid #03346E">
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->contact_number }}</td>
                                <td>{{ $user->first_name }}</td>
                                <td>{{ $inquiry->payment_method ?? '--' }}</td>                            </tr>
                        @empty
                            <tr class="table-light">
                                <td colspan="6" class="text-center">There are no derm.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Include the Pagination Component -->
                @include('admin.components.pagination', ['items' => $users])

            </div>

        </div>
    </div>
@endsection

@section('scripts')
@endsection
