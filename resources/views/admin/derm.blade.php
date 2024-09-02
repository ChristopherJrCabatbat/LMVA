@extends('admin.adminLayout')

@section('title', 'DERM')

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
        <a class="nav-link side-active" href="#"><i class="fa-solid fa-notes-medical me-2"></i> DERM</a>
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
                    <h5 class="mb-0"><i class="fa-solid fa-notes-medical me-2"></i> DERM</h5>

                    <div class="d-flex gap-4">
                        <form action="dermAdd">
                            <button class="btn dark-blue" type="submit"><i class="fas fa-plus"></i> Add DERM</button>
                        </form>

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
                    @include('admin.tables.derm_table', ['derms' => $derms])
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
                fetch(`{{ route('admin.dermSearch') }}?query=${query}`, {
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
                    fetch(`{{ route('admin.dermSearch') }}?query=`, {
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
                    fetch(`{{ route('admin.dermSearch') }}?query=${query}&page=${page}`, {
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
