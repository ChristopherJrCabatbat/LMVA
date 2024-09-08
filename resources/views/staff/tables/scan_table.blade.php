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
                <td class="fs-4">{{ $derm->derm }}</td>

                <td class="d-flex flex-column justify-content-center align-items-center">
                    <a href="{{ route('staff.dermShow', ['derm' => $derm->derm]) }}">
                        <img src="{{ asset($derm->qr_code) }}" alt="QR Code" width="95" height="95"
                            class="qr-thumbnail" title="Click to view DERM information.">
                    </a>
                    <i class="fa-solid fa-expand pointer"
                        onclick="showQRCode('{{ asset($derm->qr_code) }}')" title="Click to expand."></i>
                </td>

                <!-- Print button -->
                <td class="">
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