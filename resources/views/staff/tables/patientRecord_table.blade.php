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
                <td class="">
                    {{ $record->file_details ?: $record->original_file_name }}
                </td>
                @php
                    $filePath = 'storage/' . $record->file;
                    $fileExtension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
                    $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg', 'webp'];
                @endphp

                @if (in_array($fileExtension, $imageExtensions))
                    <td class="py-2">
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


                <td class="" style="width: 20%">
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