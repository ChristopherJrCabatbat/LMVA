<table class="table table-bordered table-blue table-info rounded">
    <thead>
        <tr>
            <th scope="col" class="">Inquiry Details</th>
            <th scope="col" class="">Payment Method</th>
            <th scope="col" class="">Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($inquiries as $inquiry)
            <tr class="table-light light-border" style="border: 1px solid #03346E">
                <td class="">{{ $inquiry->inquiry }}</td>
                <td class="">{{ $inquiry->payment_method ?? '--' }}</td>
                <td class="">
                    @if (is_null($inquiry->response))
                        Inquiry Sent
                    @else
                        <a href="#" class="status-responded fw-bold" data-bs-toggle="modal"
                            data-bs-target="#paymentModal" data-inquiry-id="{{ $inquiry->id }}">
                            <i class="fa-solid fa-circle-exclamation me-2"></i>Staff Responded
                        </a>
                    @endif
                </td>
            </tr>
        @empty
            <tr class="table-light">
                <td colspan="3" class="text-center">There are no inquiries.</td>
            </tr>
        @endforelse

    </tbody>
</table>


<!-- Include the Pagination Component -->
@include('components.staff-userPagination', ['items' => $inquiries])