@extends('staff.staffLayout')

@section('title', 'Derm')

@section('styles-links')
    <style>
        #scanModal {
            --bs-modal-margin: 0px !important;
        }
    </style>
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

    <!-- Modal for QR Code Scanning -->
    <div class="modal fade" id="scanModal" tabindex="-1" aria-labelledby="scanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scanModalLabel">Scan QR Code</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="reader" style="width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('sidebar')
    <li class="nav-item">
        <a class="nav-link" href="/staff/patientRecord"><i class="fa-solid fa-clipboard me-2"></i> Patient Record</a>
    </li>
    <li class="nav-item">
        <a class="nav-link side-active" href="#"><i class="fa-solid fa-notes-medical me-2"></i> Derm</a>
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
                    <div class="d-flex justify-content-center align-items-center">
                        <h5 class="mb-0"><i class="fa-solid fa-notes-medical me-2"></i> Derm</h5>
                        <i class="fa-solid fa-camera ms-3 fs-5 border border-primary p-2 rounded pointer camera"
                            title="Scan through this device." onclick="openScanModal()"></i>
                    </div>

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
                    @include('staff.tables.scan_table', ['derms' => $derms])
                </div>

            </div>

        </div>
    </div>
@endsection

@section('scripts')

    {{-- Open Camera --}}
    <script>
        function openScanModal() {
            const scanModal = new bootstrap.Modal(document.getElementById('scanModal'));
            scanModal.show();

            const html5QrCode = new Html5Qrcode("reader");

            // Start the QR code scanning when the modal is shown
            scanModal._element.addEventListener('shown.bs.modal', function() {
                html5QrCode.start({
                        facingMode: "environment"
                    }, // Use "environment" for rear camera
                    {
                        fps: 10,
                        qrbox: {
                            width: 250,
                            height: 250
                        }
                    },
                    qrCodeMessage => {
                        alert(`QR Code detected: ${qrCodeMessage}`);
                        html5QrCode.stop().then(() => {
                            scanModal.hide();
                        }).catch(err => console.log('Error stopping the QR Code scanner:', err));
                    },
                    errorMessage => {
                        console.log(`QR Code scan error: ${errorMessage}`);
                    }
                ).catch(err => {
                    console.log(`Unable to start scanning: ${err}`);
                });
            });

            // Stop the QR code scanning when the modal is hidden
            scanModal._element.addEventListener('hidden.bs.modal', function() {
                html5QrCode.stop().catch(err => console.log('Error stopping the QR Code scanner:', err));
            });
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
            fetch(`{{ route('staff.dermSearch') }}?query=${query}`, {
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
                fetch(`{{ route('staff.dermSearch') }}?query=`, {
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
                fetch(`{{ route('staff.dermSearch') }}?query=${query}&page=${page}`, {
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
