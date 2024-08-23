@extends('staff.staffLayout')

@section('title', 'Scan')

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
        <a class="nav-link" href="/staff/patientRecord"><i class="fa-solid fa-clipboard me-2"></i> Patient Record</a>
    </li>
    <li class="nav-item">
        <a class="nav-link side-active" href="#"><i class="fa-solid fa-qrcode me-2"></i> Scan</a>
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
                    <h5 class="mb-0"><i class="fa-solid fa-qrcode me-2"></i> Scan</h5>

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
                                <td class="align-middle">
                                    <img src="{{ asset($derm->qr_code) }}" alt="QR Code" width="100" height="100"
                                        class="qr-thumbnail" onclick="showQRCode('{{ asset($derm->qr_code) }}')">
                                </td>

                                <!-- Print button -->
                                <td class="align-middle">
                                    <a class="print" href="#"
                                        onclick="printDerm('{{ $derm->derm }}', '{{ asset($derm->qr_code) }}')"
                                        style="color: #002046;">
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
@endsection
