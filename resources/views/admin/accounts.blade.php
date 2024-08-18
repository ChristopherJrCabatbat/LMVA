@extends('admin.adminLayout')

@section('title', 'Admin Accounts')

@section('styles-links')

    <style>
        .sidebar {
            border-right: 1px solid #03346E;
        }

        .sidebar .nav-item .nav-link {
            color: white;
        }

        .sidebar .nav-item .nav-link:hover {
            background-color: #03346E;
        }

        .sidebar .nav-item .nav-link.side-active:hover {
            background-color: #0d6efd;
        }
    </style>

@endsection

@section('sidebar')
    <li class="nav-item">
        <a class="nav-link" href="/admin/dashboard"><i class="fa-solid fa-gauge me-2"></i> Dashboard</a>
    </li>
    <hr />
    <li class="nav-item">
        <a class="nav-link side-active" href="#"><i class="fa-solid fa-users me-2"></i> Accounts</a>
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
        {{-- Staff Table --}}
        <div class="table-responsive text-center p-3 bg-dark" data-bs-theme="dark">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0 text-white"><i class="fa-solid fa-users me-2"></i> Staff Accounts</h5>
                <form action="employee/create">
                    <button class="btn add" type="submit"><i class="fas fa-plus"></i>
                        Add Staff
                    </button>
                </form>
            </div>
            <table class="table table-bordered bg-dark rounded" data-bs-theme="dark">
                <thead class="">
                    <tr>
                        <th scope="col">Username</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Contact Number</th>
                        <th scope="col">Email</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($staffs as $staffs)
                        <tr>
                            <td>{{ $staffs->username }}</td>
                            <td>{{ $staffs->first_name }}</td>
                            <td>{{ $staffs->last_name }}</td>
                            <td>{{ $staffs->contact_number }}</td>
                            <td>{{ $staffs->email }}</td>
                            <td class="position-relative">
                                <div class="dropdown">
                                    <button class="btn btn-sm dropdown-toggle manageDropdown1" type="button"
                                        id="manageDropdown11" data-bs-toggle="dropdown" aria-expanded="false"><i
                                            class="fas fa-gear"></i>
                                        Manage
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end manageDropdown111"
                                        aria-labelledby="manageDropdown1" style="max-height: 16vh">
                                        <li>
                                            <a class="dropdown-item" href="employee/{{ $staffs->id }}"><i
                                                    class="fas fa-eye" style="color: green"></i> View</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="employee/{{ $staffs->id }}/edit"><i
                                                    class="fas fa-pen-to-square" style="color: blue"></i> Edit</a>
                                        </li>

                                        <li>
                                            <form action="employee/{{ $staffs->id }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item"><i class="fa-solid fa-trash"
                                                        style="color: red"></i> Delete</button>
                                            </form>

                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">There are no users.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- User Table --}}
        <div class="table-responsive text-center p-3 bg-dark" data-bs-theme="dark">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0 text-white"><i class="fa-solid fa-users me-2"></i> User Accounts</h5>
                <form action="employee/create">
                    <button class="btn add" type="submit"><i class="fas fa-plus"></i>
                        Add User
                    </button>
                </form>
            </div>
            <table class="table table-bordered bg-dark rounded" data-bs-theme="dark">
                <thead class="">
                    <tr>
                        <th scope="col">Username</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Contact Number</th>
                        <th scope="col">Email</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $users)
                        <tr>
                            <td>{{ $users->username }}</td>
                            <td>{{ $users->first_name }}</td>
                            <td>{{ $users->last_name }}</td>
                            <td>{{ $users->contact_number }}</td>
                            <td>{{ $users->email }}</td>
                            <td class="position-relative">
                                <div class="dropdown">
                                    <button class="btn btn-sm dropdown-toggle manageDropdown1" type="button"
                                        id="manageDropdown11" data-bs-toggle="dropdown" aria-expanded="false"><i
                                            class="fas fa-gear"></i>
                                        Manage
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end manageDropdown111"
                                        aria-labelledby="manageDropdown1" style="max-height: 16vh">
                                        <li>
                                            <a class="dropdown-item" href="employee/{{ $users->id }}"><i
                                                    class="fas fa-eye" style="color: green"></i> View</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="employee/{{ $users->id }}/edit"><i
                                                    class="fas fa-pen-to-square" style="color: blue"></i> Edit</a>
                                        </li>

                                        <li>
                                            <form action="employee/{{ $users->id }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item"><i class="fa-solid fa-trash"
                                                        style="color: red"></i> Delete</button>
                                            </form>

                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">There are no users.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    {{-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            var dropdownElements = document.querySelectorAll(".manageDropdown11");

            dropdownElements.forEach(function(dropdown) {
                dropdown.addEventListener("click", function(event) {
                    // var dropdownMenu = this.nextElementSibling;
                    var dropdownMenu = document.querySelectorAll(".manageDropdown111");
                    var rect = dropdown.getBoundingClientRect();
                    dropdownMenu.style.position = "absolute";
                    dropdownMenu.style.bottom = rect.bottom - 70 + "px"; // Adjust the top position
                    dropdownMenu.style.left = rect.left - 87 + "px"; // Adjust the left position
                    dropdownMenu.style.width = "200px"; // Adjust as needed
                });
            });
        });
    </script> --}}
@endsection
