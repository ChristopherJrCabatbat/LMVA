@extends('admin.adminLayout')

@section('title', 'Accounts')

@section('styles-links')
@endsection

@section('modals')
@endsection

@section('sidebar')
    <li class="nav-item">
        <a class="nav-link" href="/admin/dashboard"><i class="fa-solid fa-gauge me-2"></i> Dashboard</a>
    </li>
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
            <div class="table-responsive text-center p-3 bg-light" id="staffTable"
                style="display: {{ $activeTable === 'staff' ? 'block' : 'none' }};">

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
                        <form action="{{ route('admin.accountsAddStaff') }}">
                            <button class="btn dark-blue" type="submit"><i class="fas fa-plus"></i> Add Staff</button>
                        </form>

                        {{-- Live Search for Staff --}}
                        <form action="" class="d-flex position-relative" id="staff-search-form">
                            <button class="btn-custom" type="button">
                                <i class="ms-1 fa-solid fa-magnifying-glass"></i>
                            </button>
                            <input type="search" id="staff-search-input" class="form-control-custom rounded"
                                placeholder="Search staff..." autocomplete="off">
                        </form>

                    </div>
                </div>

                {{-- Display Search Results --}}
                <div id="staff-search-results">
                    @include('admin.tables.accounts_staff_table', ['staffs' => $staffs])
                </div>

            </div>

            {{-- User Table --}}
            <div class="table-responsive text-center p-3 bg-light" id="userTable"
                style="display: {{ $activeTable === 'user' ? 'block' : 'none' }};">

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
                        <form action="{{ route('admin.accountsAddUser') }}">
                            <button class="btn dark-blue" type="submit"><i class="fas fa-plus"></i> Add User</button>
                        </form>

                        {{-- Live Search for Users --}}
                        <form action="" class="d-flex position-relative" id="user-search-form">
                            <button class="btn-custom" type="button">
                                <i class="ms-1 fa-solid fa-magnifying-glass"></i>
                            </button>
                            <input type="search" id="user-search-input" class="form-control-custom rounded"
                                placeholder="Search user..." autocomplete="off">
                        </form>

                    </div>
                </div>

                {{-- Display Search Results --}}
                <div id="user-search-results">
                    @include('admin.tables.accounts_user_table', ['users' => $users])
                </div>

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
        document.addEventListener('DOMContentLoaded', function() {
            // Get the active table from the query parameter
            const urlParams = new URLSearchParams(window.location.search);
            const activeTable = urlParams.get('table') || 'staff';

            // Toggle the tables based on the active table
            if (activeTable === 'user') {
                document.getElementById('userTable').classList.remove('d-none');
                document.getElementById('staffTable').classList.add('d-none');
            } else {
                document.getElementById('staffTable').classList.remove('d-none');
                document.getElementById('userTable').classList.add('d-none');
            }

            // Add event listeners to the buttons to update the URL with the correct table
            document.getElementById('showStaff').addEventListener('click', function() {
                window.location.href = '?table=staff';
            });

            document.getElementById('showUsers').addEventListener('click', function() {
                window.location.href = '?table=user';
            });
        });
    </script>

    {{-- Script Search --}}
    <script>
        let debounceTimer;

        function debounce(func, delay) {
            return function(...args) {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(() => func.apply(this, args), delay);
            };
        }

        function performSearch(query, table) {
            let url = table === 'staff' ? `{{ route('admin.accountsStaffSearch') }}?query=${query}` :
                `{{ route('admin.accountsUserSearch') }}?query=${query}`;
            fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                    }
                })
                .then(response => response.text())
                .then(html => {
                    document.getElementById(`${table}-search-results`).innerHTML = html;
                });
        }

        function setupSearch(inputId, formId, table) {
            document.getElementById(inputId).addEventListener('input', debounce(function() {
                let query = this.value.trim();
                if (query.length > 0) {
                    performSearch(query, table);
                } else {
                    // Optional: Handle empty query
                    performSearch('', table);
                }
            }, 500)); // Adjust debounce delay as needed
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Initialize search for both staff and users
            setupSearch('staff-search-input', 'staff-search-form', 'staff');
            setupSearch('user-search-input', 'user-search-form', 'user');

            document.addEventListener('click', function(e) {
                if (e.target.closest('.pagination a')) {
                    e.preventDefault();
                    let page = e.target.getAttribute('href').split('page=')[1];
                    let table = document.getElementById('staffTable').style.display === 'block' ? 'staff' :
                        'user';
                    let query = document.getElementById(`${table}-search-input`).value.trim();
                    let url = table === 'staff' ?
                        `{{ route('admin.accountsStaffSearch') }}?query=${query}&page=${page}` :
                        `{{ route('admin.accountsUserSearch') }}?query=${query}&page=${page}`;
                    fetch(url, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                            }
                        })
                        .then(response => response.text())
                        .then(html => {
                            document.getElementById(`${table}-search-results`).innerHTML = html;
                        });
                }
            });
        });
    </script>

@endsection
