<table class="table table-bordered bg-dark rounded" data-bs-theme="dark">
    <thead>
        <tr>
            <th class="" scope="col">Username</th>
            <th class="" scope="col">First Name</th>
            <th class="" scope="col">Last Name</th>
            <th class="" scope="col">Contact Number</th>
            <th class="" scope="col">Email</th>
            <th class="" scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($users as $user)
            <tr class="table-light light-border" style="border: 1px solid #03346E">
                <td>{{ $user->username }}</td>
                <td>{{ $user->first_name }}</td>
                <td>{{ $user->last_name }}</td>
                <td>{{ $user->contact_number }}</td>
                <td>{{ $user->email }}</td>
                <td class="position-relative">
                    <div class="dropdown-custom">
                        <button class="btn btn-sm dropdown-toggle manageDropdown1" type="button">
                            <i class="fas fa-gear"></i> Manage
                        </button>
                        <ul class="dropdown-menu-custom dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.accountsUserShow', $user->id) }}">
                                    <i class="fas fa-eye" style="color: green"></i> View
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.accountsEdit', $user->id) }}">
                                    <i class="fas fa-pen-to-square" style="color: blue"></i> Edit
                                </a>
                            </li>
                            <li>
                                <form action="{{ route('admin.accountDestroy', $user->id) }}"
                                    method="POST" id="delete-form-{{ $user->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="dropdown-item"
                                        onclick="confirmDelete({{ $user->id }})">
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
                <td colspan="6" class="text-center">There are no user accounts.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<!-- Include the Pagination Component -->
@include('admin.components.accounts-pagination', ['items' => $users])