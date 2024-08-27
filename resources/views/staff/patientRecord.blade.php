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
                            <th scope="col">File Details</th>
                            <th scope="col">File</th>
                            <th scope="col">Categorize</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($records as $record)
                            <tr class="table-light light-border">
                                <!-- Display the file details or fallback to the original file name -->
                                <td class="align-middle">
                                    {{ $record->file_details ?: $record->original_file_name }}
                                </td>
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
                                        <a href="{{ asset($filePath) }}" class="view-file rounded p-2 px-3" target="_blank"
                                            title="This will open the file in a new tab.">
                                            {{ $record->original_file_name }}
                                        </a>
                                    </td>
                                @endif


                                <td class="align-middle" style="width: 20%">
                                    <form action="{{ route('staff.patientRecordCategorize') }}" method="POST"
                                        id="categorizeForm-{{ $record->id }}">
                                        @csrf
                                        <select class="form-select" name="category" id="category"
                                            aria-label="Default select example" title="Choose DERM to categorize the file."
                                            onchange="confirmCategorization('{{ $record->id }}', this)">
                                            <option value="" disabled selected>Categorize file</option>
                                            @foreach ($derms as $derm)
                                                <option value="{{ $derm->derm }}">{{ $derm->derm }}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="record_id" value="{{ $record->id }}">
                                    </form>
                                </td>

                            </tr>
                        @empty
                            <tr class="table-light">
                                <td colspan="3" class="text-center">There are no patient records to be categorized.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>


                <!-- Include the Pagination Component -->
                @include('components.staff-userPagination', ['items' => $records])

            </div>

        </div>
    </div>
@endsection

@section('scripts')
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
@endsection
