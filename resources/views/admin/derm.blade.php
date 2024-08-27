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
                        <form action="" class="d-flex">
                            <input type="search" class="form-control-custom rounded-start-custom"
                                placeholder="Search something...">
                            <button class="btn-custom dark-blue rounded-end-custom" type="submit"><i
                                    class="fa-solid fa-magnifying-glass"></i></button>
                        </form>

                    </div>
                </div>

                <!-- Existing Table -->
                <table class="table table-bordered bg-dark rounded" data-bs-theme="dark">
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
                                        class="qr-thumbnail" onclick="showQRCode('{{ asset($derm->qr_code) }}')">
                                </td> --}}
                                
                                <td class="align-middle d-flex flex-column">
                                    <a href="{{ route('admin.dermShow', ['derm' => $derm->derm]) }}">
                                        <img src="{{ asset($derm->qr_code) }}" title="Click to view files associated with {{ $derm->derm }}." alt="QR Code" width="95" height="95" class="qr-thumbnail">
                                    </a>
                                    <i class="fa-solid fa-expand pointer" onclick="showQRCode('{{ asset($derm->qr_code) }}')"
                                        title="Click to expand."></i>
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
                                <td colspan="3" class="text-center">There are no derms available.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Include the Pagination Component -->
                @include('admin.components.pagination', ['items' => $derms])

            </div>
        </div>
    @endsection

    @section('scripts')
    @endsection
