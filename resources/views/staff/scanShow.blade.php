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

            <div class="table-responsive text-center p-3 bg-light position-relative">
                <div class="position-absolute top-0 start-0 p-3">
                    <a href="{{ route('staff.derm') }}">
                        <i class="fa-solid fa-circle-left fs-2 back"></i>
                    </a>
                </div>

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
                                @php
                                    $filePath = 'storage/' . $record->file;
                                    $fileExtension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
                                    $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg', 'webp'];
                                @endphp

                                @if (in_array($fileExtension, $imageExtensions))
                                    <td class="py-2 align-middle">
                                        <!-- Display the image full screen -->
                                        <img src="{{ asset($filePath) }}" alt="{{ $record->original_file_name }}"
                                            height="70" onclick="showQRCode('{{ asset($filePath) }}')"
                                            style="cursor: pointer;" title="Click to expand.">
                                    </td>
                                @else
                                    <td class="py-3">
                                        <a href="{{ asset($filePath) }}" class="view-file rounded p-2 px-3" target="_blank" title="This will open the file in a new tab.">
                                            <i class="fa-solid fa-file-lines me-3"></i> <!-- FontAwesome Icon -->
                                            {{ $record->original_file_name }}
                                        </a>   
                                    </td>
                                @endif
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
