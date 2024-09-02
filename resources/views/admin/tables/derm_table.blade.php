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

                <td class="align-middle d-flex flex-column justify-content-center align-items-center">
                    <a href="{{ route('admin.dermShow', ['derm' => $derm->derm]) }}">
                        <img src="{{ asset($derm->qr_code) }}"
                            title="Click to view files associated with {{ $derm->derm }}." alt="QR Code"
                            width="95" height="95" class="qr-thumbnail">
                    </a>
                    <i class="fa-solid fa-expand pointer"
                        onclick="showQRCode('{{ asset($derm->qr_code) }}')" title="Click to expand."></i>
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