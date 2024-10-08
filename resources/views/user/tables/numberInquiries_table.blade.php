@php
// Get the current page number and items per page
$currentPage = $inquiries->currentPage();
$perPage = $inquiries->perPage();
@endphp

<table class="table table-bordered table-blue table-info rounded">
<thead>
    <tr>
        <th class="">No.</th>
        <th class="">Patient Name</th>
        <th class="">Inquiry Details</th>
        <th class="">Inquiry History</th>
        <th class="">Date</th>
    </tr>
</thead>
<tbody>
    {{-- @forelse ($inquiries as $user) --}}
    @forelse ($inquiries as $index => $inquiry)
        <tr class="table-light light-border" style="border: 1px solid #03346E">
            <td class="">{{ ($currentPage - 1) * $perPage + $index + 1 }}</td>
            <td class="">{{ $inquiry->patient_name }}</td>
            <td class="">{{ $inquiry->inquiry }}</td>
            {{-- <td class=""><a href="{{ route('user.numberInquiriesHistory', $inquiry->id) }}"><i class="me-2 fa-solid fa-eye pointer" style="color: #0d6efd;" title="View your inquiry history."></i></a></td> --}}
            <td class=""><a href="{{ route('user.numberInquiriesHistory', $inquiry->id) }}"
                    class="rounded btn btn-primary"><i class="me-1 fa-solid fa-eye pointer"
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
@include('components.staff-userPagination', ['items' => $inquiries])