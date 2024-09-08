<table class="table table-bordered bg-dark rounded" data-bs-theme="dark">
    <thead>
        <tr>
            <th class="">Username</th>
            <th class="">Email</th>
            <th class="">Patient Name</th>
            <th class="">Staff</th>
            <th class="">Overview</th>
            <th class="">Date</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($inquiries as $index => $inquiry)
            <tr class="table-light light-border" style="border: 1px solid #03346E">
                <td class="">{{ $inquiry->username }}</td>
                <td class="">{{ $inquiry->email }}</td>
                <td class="">{{ $inquiry->patient_name }}</td>
                <td class="">{{ $inquiry->staff ?? 'No staff responded yet.' }}</td>
                <td class=" py-3" style="white-space: nowrap;"><a
                        href="{{ route('admin.reportsHistory', $inquiry->id) }}" class="py-2 px-3 rounded dark-blue"><i
                            class="me-1 fa-solid fa-eye pointer"
                            title="View your inquiry history."></i>View</a></td>
                <td class="" style="width: 20%">
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