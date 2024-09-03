@extends('staff.staffLayout')

@section('title', 'Patient Record')

@section('styles-links')

@endsection

@section('modals')
    <!-- Full-screen image Modal -->
    <div id="qrCodeModal" class="qr-code-modal">
        <span class="close" onclick="closeQRCode()">&times;</span>
        <img class="qr-code-modal-content" id="qrCodeImage">
    </div>
@endsection

@section('sidebar')
    <li class="nav-item">
        <a class="nav-link side-active" href="#"><i class="fa-solid fa-clipboard me-2"></i> Patient Record</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/staff/derm"><i class="fa-solid fa-notes-medical me-2"></i> Derm</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/staff/inquiry"><i class="fa-solid fa-magnifying-glass-arrow-right me-2"></i>
            Inquiry</a>
    </li>
@endsection

@section('main-content')
    <div class="container pt-5 d-flex flex-column gap-5">
        <div class="d-flex flex-column">

            <div class="table-responsive text-center p-3 bg-light" id="staffTable">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0"><i class="fa-solid fa-clipboard me-2"></i> Patient Records</h5>

                    <div class="d-flex gap-4">
                        {{-- Live Search --}}
                        <form action="" class="d-flex position-relative">
                            <button class="btn-custom" type="button">
                                <i class="ms-1 fa-solid fa-magnifying-glass" style="color: #0d6efd"></i>
                            </button>
                            <input type="search" id="search-input" class="form-control-custom rounded"
                                placeholder="Search something..." autocomplete="off">
                        </form>

                    </div>
                </div>

                {{-- Display Search Results --}}
                <div id="search-results">
                    @include('staff.tables.patientRecord_table', ['records' => $records, 'derms' => $derms])
                </div>

            </div>

        </div>
    </div>
@endsection

@section('scripts')
    {{-- Categorize confirmation --}}
    <script>
        function confirmCategorization(recordId, selectElement) {
            const selectedOption = selectElement.options[selectElement.selectedIndex].text;
            const confirmation = confirm(`Are you sure you want to categorize this record/file as "${selectedOption}"?`);

            if (confirmation) {
                document.getElementById(`categorizeForm-${recordId}`).submit();
            } else {
                // If user cancels, reset the select element to its initial state
                selectElement.selectedIndex = 0;
            }
        }
    </script>

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
            fetch(`{{ route('staff.patientRecordSearch') }}?query=${query}`, {
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
                fetch(`{{ route('staff.patientRecordSearch') }}?query=`, {
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
                fetch(`{{ route('staff.patientRecordSearch') }}?query=${query}&page=${page}`, {
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