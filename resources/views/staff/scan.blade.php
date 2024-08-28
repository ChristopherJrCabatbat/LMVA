@extends('staff.staffLayout')

@section('title', 'Derm')

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
                        {{-- <form action="dashboardAdd">
                        <button class="btn dark-blue" type="submit"><i class="fas fa-plus"></i> Add Record</button>
                    </form> --}}
                        <form action="" class="d-flex">
                            <input type="search" class="form-control-custom rounded-start-custom"
                                placeholder="Search something...">
                            <button class="btn-custom dark-blue rounded-end-custom" type="submit"><i
                                    class="fa-solid fa-magnifying-glass"></i></button>
                        </form>

                    </div>
                </div>


                <table class="table table-bordered table-blue table-info rounded">
                    <thead>
                        <tr>
                            <th scope="col">DERM</th>
                            <th scope="col">QR Code</th>
                            <th scope="col">Print</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($derms as $derm)
                            <tr class="table-light light-border" style="border: 1px solid #03346E">
                                <!-- Display the DERM name -->
                                <td class="align-middle fs-4">{{ $derm->derm }}</td>

                                <!-- Display the QR code image -->
                                {{-- <td class="align-middle">
                                    <img src="{{ asset($derm->qr_code) }}" alt="QR Code" width="100" height="100"
                                        class="qr-thumbnail" onclick="showQRCode('{{ asset($derm->qr_code) }}')" title="Click to expand.">
                                </td> --}}
                                <td class="align-middle d-flex flex-column">
                                    <a href="{{ route('staff.dermShow', ['derm' => $derm->derm]) }}">
                                        <img src="{{ asset($derm->qr_code) }}" alt="QR Code" width="95" height="95"
                                            class="qr-thumbnail" title="Click to view DERM information.">
                                    </a>
                                    <i class="fa-solid fa-expand pointer"
                                        onclick="showQRCode('{{ asset($derm->qr_code) }}')" title="Click to expand."></i>
                                </td>

                                <!-- Print button -->
                                <td class="align-middle">
                                    <a class="print" href="#"
                                        onclick="printDerm('{{ $derm->derm }}', '{{ asset($derm->qr_code) }}')"
                                        style="color: #002046;" title="Print the QR Code.">
                                        <i class="fa-solid fa-print fs-1"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr class="table-light">
                                <td colspan="6" class="text-center">There are no QR Code.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Include the Pagination Component -->
                @include('components.staff-userPagination', ['items' => $derms])

            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function openScanModal() {
            const scanModal = new bootstrap.Modal(document.getElementById('scanModal'));
            scanModal.show();

            const html5QrCode = new Html5Qrcode("reader");

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

            scanModal._element.addEventListener('hidden.bs.modal', function() {
                html5QrCode.stop().catch(err => console.log('Error stopping the QR Code scanner:', err));
            });
        }
    </script>

    {{-- <script>
        const scanner = new Html5QrcodeScanner('reader', {
            // Scanner will be initialized in DOM inside element with id of 'reader'
            qrbox: {
                width: 250,
                height: 250,
            }, // Sets dimensions of scanning box (set relative to reader element width)
            fps: 20, // Frames per second to attempt a scan
        });


        scanner.render(success, error);
        // Starts scanner

        function success(result) {

            document.getElementById('result').innerHTML = `
        <h2>Success!</h2>
        <p><a href="${result}">${result}</a></p>
        `;
            // Prints result as a link inside result element

            scanner.clear();
            // Clears scanning instance

            document.getElementById('reader').remove();
            // Removes reader element from DOM since no longer needed

        }

        function error(err) {
            console.error(err);
            // Prints any errors to the console
        }
    </script> --}}

@endsection
