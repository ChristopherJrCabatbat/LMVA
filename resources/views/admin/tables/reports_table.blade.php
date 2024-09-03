<table class="table table-bordered bg-dark rounded" data-bs-theme="dark">
    <thead>
        <tr>
            <th class="align-middle">Username</th>
            <th class="align-middle">Email</th>
            <th class="align-middle">Patient Name</th>
            <th class="align-middle">Staff</th>
            <th class="align-middle">Inquiry Overview</th>
            <th class="align-middle">Date</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($inquiries as $index => $inquiry)
            <tr class="table-light light-border" style="border: 1px solid #03346E">
                <td class="align-middle">{{ $inquiry->username }}</td>
                <td class="align-middle">{{ $inquiry->email }}</td>
                <td class="align-middle">{{ $inquiry->patient_name }}</td>
                <td class="align-middle">{{ $inquiry->staff }}</td>
                <td class="align-middle py-3"><a
                        href="{{ route('admin.reportsHistory', $inquiry->id) }}" class="p-2 rounded dark-blue"><i
                            class="me-1 fa-solid fa-eye pointer"
                            title="View your inquiry history."></i>View</a></td>
                <td class="align-middle" style="width: 20%">
                    {{ \Carbon\Carbon::parse($inquiry->date)->format('F j, Y') }}</td>
                {{-- Format date --}}
            </tr>
        @empty
            <tr class="table-light">
                <td colspan="6" class="text-center">There are no inquiries.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<!-- Include the Pagination Component -->
@include('admin.components.pagination', ['items' => $inquiries])