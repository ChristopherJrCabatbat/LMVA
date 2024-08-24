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
@endsection

@section('sidebar')
    <li class="nav-item">
        <a class="nav-link" href="/staff/patientRecord"><i class="fa-solid fa-clipboard me-2"></i> Patient Record</a>
    </li>
    <li class="nav-item">
        <a class="nav-link side-active" href="/staff/derm"><i class="fa-solid fa-notes-medical me-2"></i> Derm</a>
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
                <div class="d-flex justify-content-center align-items-center mb-3">
                    <h4 class="mb-0"><i class="fa-solid fa-notes-medical me-2"></i> {{ $dermRecord->derm }} Records</h4>
                </div>

                <table class="table table-bordered table-blue table-info rounded">
                    <thead>
                        <tr>
                            <th>File Details</th>
                            <th>File</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($records as $record)
                            <tr class="table-light light-border" style="border: 1px solid #03346E">
                                <td class="align-middle">{{ $record->file_details ?: $record->original_file_name }}</td>
                                <td class="align-middle py-3">
                                    <a href="{{ asset('storage/' . $record->file) }}" target="_blank"
                                        class="view-file rounded p-2 px-3" title="See the files in this DERM.">
                                        {{ $record->original_file_name }}
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr class="table-light">
                                <td colspan="6" class="text-center">No files found for this DERM.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Include the Pagination Component -->
                {{-- @include('components.staff-userPagination', ['items' => $derms]) --}}

            </div>

        </div>
    </div>
@endsection

@section('scripts')
@endsection
