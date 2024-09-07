<table class="table table-bordered bg-dark rounded" data-bs-theme="dark">
    <thead>
        <tr>
            <th class="align-middle" scope="col">Username</th>
            <th class="align-middle" scope="col">First Name</th>
            <th class="align-middle" scope="col">Last Name</th>
            <th class="align-middle" scope="col">Contact Number</th>
            <th class="align-middle" scope="col">Email</th>
            <th class="align-middle" scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($staffs as $staff)
            <tr class="table-light light-border" style="border: 1px solid #03346E">
                <td>{{ $staff->username }}</td>
                <td>{{ $staff->first_name }}</td>
                <td>{{ $staff->last_name }}</td>
                <td>{{ $staff->contact_number }}</td>
                <td>{{ $staff->email }}</td>
                <td class="position-relative">
                    <div class="dropdown-custom">
                        <button class="btn btn-sm dropdown-toggle manageDropdown1" type="button">
                            <i class="fas fa-gear"></i> Manage
                        </button>
                        <ul class="dropdown-menu-custom dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.accountsStaffShow', $staff->id) }}">
                                    <i class="fas fa-eye" style="color: green"></i> View
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.accountsEdit', $staff->id) }}">
                                    <i class="fas fa-pen-to-square" style="color: blue"></i> Edit
                                </a>
                            </li>
                            <li>
                                <form action="{{ route('admin.accountDestroy', $staff->id) }}"
                                    method="POST" id="delete-form-{{ $staff->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="dropdown-item"
                                        onclick="confirmDelete({{ $staff->id }})">
                                        <i class="fa-solid fa-trash" style="color: red"></i> Delete
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
        @empty
            <tr class="table-light">
                <td colspan="6" class="text-center">There are no staff accounts.</td>
            </tr>
        @endforelse
    </tbody>
</table>

 <!-- Include the Pagination Component -->
 @include('admin.components.accounts-pagination', ['items' => $staffs])