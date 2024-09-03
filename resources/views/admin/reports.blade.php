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

                        {{-- Live Search --}}
                        <form action="" class="d-flex position-relative">
                            <button class="btn-custom" type="button">
                                <i class="ms-1 fa-solid fa-magnifying-glass"></i>
                            </button>
                            <input type="search" id="search-input" class="form-control-custom rounded"
                                placeholder="Search something..." autocomplete="off">
                        </form>

                    </div>
                </div>

                {{-- Display Search Results --}}
                <div id="search-results">
                    @include('admin.tables.reports_table', ['inquiries' => $inquiries])
                </div>

            </div>

        </div>
    </div>
@endsection

@section('scripts')
    {{-- Search Script --}}
    <script>
        let debounceTimer;

        function debounce(func, delay) {
            return function(...args) {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(() => func.apply(this, args), delay);
            };
        }

        function performSearch(query) {
            fetch(`{{ route('admin.reportsSearch') }}?query=${query}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                    }
                })
                .then(response => response.text())
                .then(html => {
                    document.getElementById('search-results').innerHTML = html;
                });
        }

        document.getElementById('search-input').addEventListener('input', debounce(function() {
            let query = this.value.trim();
            if (query.length > 0) {
                performSearch(query);
            } else {
                // Optional: Handle the case when the search box is empty
                // You may need to ensure the server-side handles an empty query correctly
                fetch(`{{ route('admin.reportsSearch') }}?query=`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                        }
                    })
                    .then(response => response.text())
                    .then(html => {
                        document.getElementById('search-results').innerHTML = html;
                    });
            }
        }, 500)); // Adjust the debounce delay as needed

        document.addEventListener('click', function(e) {
            if (e.target.closest('.pagination a')) {
                e.preventDefault();
                let page = e.target.getAttribute('href').split('page=')[1];
                let query = document.getElementById('search-input').value.trim();
                fetch(`{{ route('admin.reportsSearch') }}?query=${query}&page=${page}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                        }
                    })
                    .then(response => response.text())
                    .then(html => {
                        document.getElementById('search-results').innerHTML = html;
                    });
            }
        });
    </script>
@endsection
