@extends('admin.adminLayout')

@section('title', 'Admin Dashboard')

@section('styles-links')
@endsection

@section('sidebar')
    <li class="nav-item">
        <a class="nav-link side-active" href="#"><i class="fa-solid fa-gauge me-2"></i> Dashboard</a>
    </li>
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
                            <button class="btn dark-blue" type="submit"><i class="fas fa-plus"></i> Add Record</button>
                        </form>
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
                            <th scope="col">File Details</th>
                            <th scope="col">File</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($records as $record)
                            <tr class="table-light light-border">
                                <!-- Display the file details or fallback to the original file name -->
                                <td class="align-middle">
                                    {{ $record->file_details ?: $record->original_file_name }}
                                </td>
                                <td class="py-3">
                                    <a href="{{ asset('storage/' . $record->file) }}" class="view-file rounded p-2 px-3"
                                        target="_blank" title="This will open the file to a new tab.">
                                        {{ $record->original_file_name }}
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center table-light">There are no records.</td>
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
