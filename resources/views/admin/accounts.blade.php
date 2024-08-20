@extends('admin.adminLayout')

@section('title', 'Admin Accounts')

@section('styles-links')
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
        <div class="d-flex flex-column">

            {{-- Staff Table --}}
            <div class="table-responsive text-center p-3 bg-light" id="staffTable">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex justify-content-center align-items-center gap-4">
                        <h5 class="mb-0"><i class="fa-solid fa-user me-2"></i> Staff Accounts</h5>
                        <button class="btn btn-outline-primary d-flex align-items-center gap-2" id="showUsers"
                            title="Switch to User Accounts">
                            <i class="fa-solid fa-right-left"></i>
                            <i class="fa-solid fa-users"></i>
                        </button>
                    </div>

                    <div class="d-flex gap-4">
                        <form action="employee/create">
                            <button class="btn add" type="submit"><i class="fas fa-plus"></i> Add Staff</button>
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
                            <th scope="col">Username</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Contact Number</th>
                            <th scope="col">Email</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($staffs as $staff)
                            <tr class="table-light" style="border: 1px solid #03346E">
                                <td>{{ $staff->username }}</td>
                                <td>{{ $staff->first_name }}</td>
                                <td>{{ $staff->last_name }}</td>
                                <td>{{ $staff->contact_number }}</td>
                                <td>{{ $staff->email }}</td>
                                <td class="position-relative">
                                    <div class="dropdown-custom">
                                        <button class="btn btn-sm dropdown-toggle manageDropdown1" type="button">
                                            <i class="fas fa-gear"></i> Manage
                                        </button>
                                        <ul class="dropdown-menu-custom dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item" href="employee/{{ $staff->id }}">
                                                    <i class="fas fa-eye" style="color: green"></i> View
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="employee/{{ $staff->id }}/edit">
                                                    <i class="fas fa-pen-to-square" style="color: blue"></i> Edit
                                                </a>
                                            </li>
                                            <li>
                                                <form action="employee/{{ $staff->id }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item">
                                                        <i class="fa-solid fa-trash" style="color: red"></i> Delete
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">There are no staff accounts.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{-- Staff Pagination --}}
                <nav aria-label="Staff Pagination">
                    {{-- <ul class="pagination justify-content-end"> --}}
                    <!-- Add your pagination links here -->
                    </ul>
                </nav>
            </div>

            {{-- User Table --}}
            <div class="table-responsive text-center p-3 bg-light d-none" id="userTable">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex justify-content-center align-items-center gap-4">
                        <h5 class="mb-0"><i class="fa-solid fa-users me-2"></i> User Accounts</h5>
                        <button class="btn btn-outline-primary d-flex align-items-center gap-2" id="showStaff"
                            title="Switch to Staff Accounts">
                            <i class="fa-solid fa-right-left"></i>
                            <i class="fa-solid fa-user"></i>
                        </button>
                    </div>

                    <div class="d-flex gap-4">
                        <form action="employee/create">
                            <button class="btn add" type="submit"><i class="fas fa-plus"></i> Add User</button>
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
                            <th scope="col">Username</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Contact Number</th>
                            <th scope="col">Email</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr class="table-light" style="border: 1px solid #03346E">
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->first_name }}</td>
                                <td>{{ $user->last_name }}</td>
                                <td>{{ $user->contact_number }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="position-relative">
                                    <div class="dropdown-custom">
                                        <button class="btn btn-sm dropdown-toggle manageDropdown1" type="button">
                                            <i class="fas fa-gear"></i> Manage
                                        </button>
                                        <ul class="dropdown-menu-custom dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item" href="employee/{{ $user->id }}">
                                                    <i class="fas fa-eye" style="color: green"></i> View
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="employee/{{ $user->id }}/edit">
                                                    <i class="fas fa-pen-to-square" style="color: blue"></i> Edit
                                                </a>
                                            </li>
                                            <li>
                                                <form action="employee/{{ $user->id }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item">
                                                        <i class="fa-solid fa-trash" style="color: red"></i> Delete
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">There are no user accounts.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{-- User Pagination --}}
                <nav aria-label="User Pagination">
                    <ul class="pagination justify-content-end">
                        {{-- {{ $users->links('pagination::bootstrap-5') }} --}}

                        <!-- Add your pagination links here -->
                    </ul>
                </nav>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    {{-- Manage dropdown --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownButtons = document.querySelectorAll('.manageDropdown1');
            const dropdownMenus = document.querySelectorAll('.dropdown-menu-custom');

            dropdownButtons.forEach((dropdownButton, index) => {
                const dropdownMenu = dropdownMenus[index];

                dropdownButton.addEventListener('click', function(e) {
                    e.stopPropagation();
                    dropdownMenus.forEach((menu) => menu.classList.remove(
                        'show')); // Close other open menus
                    dropdownMenu.classList.toggle('show'); // Toggle the current menu
                });

                document.addEventListener('click', function(e) {
                    if (!dropdownButton.contains(e.target)) {
                        dropdownMenu.classList.remove('show');
                    }
                });
            });
        });
    </script>


   {{-- Table shift between staff and user --}}
<script>
    document.getElementById('showStaff').addEventListener('click', function() {
        document.getElementById('staffTable').classList.remove('d-none');
        document.getElementById('userTable').classList.add('d-none');
    });

    document.getElementById('showUsers').addEventListener('click', function() {
        document.getElementById('userTable').classList.remove('d-none');
        document.getElementById('staffTable').classList.add('d-none');
    });
</script>

@endsection
