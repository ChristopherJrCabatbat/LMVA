<table class="table table-bordered table-blue table-info rounded">
    <thead>
        <tr>
            <th scope="col" class="align-middle">Email</th>
            <th scope="col" class="align-middle">Contact Number</th>
            <th scope="col" class="align-middle">Inquiry Details</th>
            <th scope="col" class="align-middle">Payment Method</th>
            <th scope="col" class="align-middle">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($inquiries as $inquiry)
            <tr class="table-light light-border" style="border: 1px solid #03346E">
                <td class="align-middle">{{ $inquiry->email }}</td>
                <td class="align-middle">{{ $inquiry->contact_number }}</td>
                <td class="align-middle">{{ $inquiry->inquiry }}</td>
                <td class="align-middle">{{ $inquiry->payment_method ?? '--' }}</td>
                <td class="align-middle"><a href="{{ route('staff.inquiryRespond', $inquiry->id) }}"
                        title="Click to respond to this inquiry." class="pointer respond">Respond</a></td>
            </tr>
        @empty
            <tr class="table-light">
                <td colspan="6" class="text-center">There are no inquiries.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<!-- Include the Pagination Component -->
@include('components.staff-userPagination', ['items' => $inquiries])