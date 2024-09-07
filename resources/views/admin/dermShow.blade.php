@extends('admin.adminLayout')

@section('title', 'Admin DERM')

@section('styles-links')
@endsection

@section('modals')
    <!-- Full-screen QR Code Modal -->
    <div id="qrCodeModal" class="qr-code-modal">
        <span class="close" onclick="closeQRCode()">&times;</span>
        <img class="qr-code-modal-content" id="qrCodeImage">
    </div>

    <!-- Hidden Print Area -->
    <div id="printArea" style="visibility:hidden; position: absolute; top: 0; left: 0;">
        <div id="printContent" style="text-align: center;">
            <!-- Content will be injected here dynamically -->
        </div>
    </div>
@endsection

@section('sidebar')
    <li class="nav-item">
        <a class="nav-link" href="/admin/dashboard"><i class="fa-solid fa-gauge me-2"></i> Dashboard</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/admin/accounts"><i class="fa-solid fa-users me-2"></i> Accounts</a>
    </li>
    <li class="nav-item">
        <a class="nav-link side-active" href="/admin/derm"><i class="fa-solid fa-notes-medical me-2"></i> DERM</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/admin/reports"><i class="fa-solid fa-newspaper me-2"></i> Reports</a>
    </li>

@endsection

@section('main-content')
    <div class="container pt-5 d-flex flex-column gap-5">
        <div class="d-flex flex-column">

            <div class="table-responsive text-center p-3 bg-light position-relative">
                <div class="position-absolute top-0 start-0 p-3">
                    <a href="{{ route('admin.derm', ['page' => request()->input('page', 1)]) }}">
                        <i class="fa-solid fa-circle-left fs-2 back"></i>
                    </a>
                </div>
            
                <div class="d-flex justify-content-center align-items-center mb-4 position-relative">
                    <h4 class="mb-0 mx-auto"><i class="fa-solid fa-notes-medical me-2"></i> {{ $dermRecord->derm }} Records</h4>
            
                    {{-- Live Search --}}
                    <form action="" class="d-flex position-absolute end-0">
                        <button class="btn-custom ps-1" type="button">
                            <i class="ms-2 fa-solid fa-magnifying-glass"></i>
                        </button>
                        <input type="search" id="search-input" class="form-control-custom rounded ms-2"
                            placeholder="Search something..." autocomplete="off">
                    </form>
                </div>
            
                {{-- Display Search Results --}}
                <div id="search-results">
                    @include('admin.tables.dermShow_table', [
                        'records' => $records,
                        'dermRecord' => $dermRecord,
                    ])
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

            function performSearch(query, derm) {
                fetch(`/admin/dermShowSearch/${derm}?query=${query}`, { // Use direct URL with derm
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
                let derm = '{{ $dermRecord->derm }}'; // Pass the derm variable dynamically
                if (query.length > 0) {
                    performSearch(query, derm);
                } else {
                    performSearch('', derm); // Handle empty query by still passing derm
                }
            }, 500)); // Adjust the debounce delay as needed

            document.addEventListener('click', function(e) {
                if (e.target.closest('.pagination a')) {
                    e.preventDefault();
                    let page = e.target.getAttribute('href').split('page=')[1];
                    let query = document.getElementById('search-input').value.trim();
                    let derm = '{{ $dermRecord->derm }}'; // Pass the derm variable dynamically
                    fetch(`/admin/dermShowSearch/${derm}?query=${query}&page=${page}`, { // Use direct URL with derm
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
