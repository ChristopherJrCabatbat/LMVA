<!-- Existing Table -->
<table class="table table-bordered bg-dark rounded" data-bs-theme="dark">
    <thead>
        <tr>
            <th>File Details</th>
            <th>File</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($records as $record)
            <tr class="table-light light-border" style="border: 1px solid #03346E">
                <td class="">{{ $record->file_details ?: $record->original_file_name }}</td>
                @php
                    $filePath = 'storage/' . $record->file;
                    $fileExtension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
                    $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg', 'webp'];
                @endphp

                @if (in_array($fileExtension, $imageExtensions))
                    <td class="py-2">
                        <!-- Display the image full screen -->
                        <img src="{{ asset($filePath) }}" alt="{{ $record->original_file_name }}" height="70"
                            onclick="showQRCode('{{ asset($filePath) }}')" style="cursor: pointer;"
                            title="Click to expand.">
                    </td>
                @else
                    <td class="py-3">
                        <a href="{{ asset($filePath) }}" class="view-file rounded p-2 px-3" target="_blank"
                            title="This will open the file in a new tab.">
                            <i class="fa-solid fa-file-lines me-3"></i> <!-- FontAwesome Icon -->
                            {{ $record->original_file_name }}
                        </a>
                    </td>
                @endif
            </tr>
        @empty
            <tr class="table-light">
                <td colspan="3" class="text-center">No files found for this DERM.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<!-- Include the Pagination Component -->
@include('admin.components.pagination', ['items' => $records])
