@extends('admin.adminLayout')

@section('title', 'Edit Account')

@section('styles-links')
@endsection

@section('modals')
@endsection

@section('sidebar')
    <li class="nav-item">
        <a class="nav-link" href="/admin/dashboard"><i class="fa-solid fa-gauge me-2"></i> Dashboard</a>
    </li>
    <li class="nav-item">
        <a class="nav-link side-active" href="#"><i class="fa-solid fa-users me-2"></i> Accounts</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/admin/derm"><i class="fa-solid fa-notes-medical me-2"></i> DERM</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/admin/reports"><i class="fa-solid fa-newspaper me-2"></i> Reports</a>
    </li>

@endsection

@section('main-content')
    <div class="container pt-5 d-flex flex-column gap-5">
        <div class="d-flex flex-column">

            <div class="table-responsive p-4 bg-light mx-auto position-relative">
                <div class="position-absolute top-0 start-0 p-4">
                    <a href="{{ route('admin.accounts') }}">
                        <i class="fa-solid fa-circle-left fs-2 back"></i>
                    </a>
                </div>

                <form action="{{ route('admin.accountsUpdate', $users->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <h3 class="mb-4 text-center"><i class="fa-solid fa-pen-to-square me-2"></i> Edit Account</h3>

                    <div class="row justify-content-center">

                        <!-- Left Column -->
                        <div class="col-md-6">
                            <!-- First Name -->
                            <div class="mb-3 d-flex flex-column align-items-start">
                                <label class="form-label fw-bold">First Name:</label>
                                <input type="text" name="first_name" class="form-control"
                                    value="{{ old('first_name', $users->first_name) }}" required>
                            </div>

                            <!-- Username -->
                            <div class="mb-3 d-flex flex-column align-items-start">
                                <label class="form-label fw-bold">Username:</label>
                                <input type="text" name="username" class="form-control"
                                    value="{{ old('username', $users->username) }}" required>
                            </div>
                            @error('username')
                                <div class="mt-3 login-error text-start alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror

                            <!-- Role -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Role:</label>
                                <select class="form-select" id="role" name="role" required>
                                    <option value="User" {{ old('role', $users->role) == 'User' ? 'selected' : '' }}>User
                                    </option>
                                    <option value="Staff" {{ old('role', $users->role) == 'Staff' ? 'selected' : '' }}>
                                        Staff</option>
                                </select>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="col-md-6">
                            <!-- Last Name -->
                            <div class="mb-3 d-flex flex-column align-items-start">
                                <label class="form-label fw-bold">Last Name:</label>
                                <input type="text" name="last_name" class="form-control"
                                    value="{{ old('last_name', $users->last_name) }}" required>
                            </div>

                            <!-- Email -->
                            <div class="mb-3 d-flex flex-column align-items-start">
                                <label class="form-label fw-bold">Email:</label>
                                <input type="email" name="email" class="form-control"
                                    value="{{ old('email', $users->email) }}" required>
                            </div>
                            @error('email')
                                <div class="mt-3 login-error text-start alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror

                            <!-- Contact Number -->
                            <div class="mb-3 d-flex flex-column align-items-start">
                                <label class="form-label fw-bold">Contact Number:</label>
                                <input type="tel" name="contact_number" class="form-control" pattern="[0-9+\-() ]*"
                                    title="Please provide a valid contact number."
                                    value="{{ old('contact_number', $users->contact_number) }}" required>
                            </div>
                        </div>

                        <!-- Password and Confirm Password in the Same Row -->
                        <div class="col-md-6">
                            <div class="mb-3 d-flex flex-column align-items-start">
                                <label class="form-label fw-bold">Password:</label>
                                <input type="password" name="password" class="form-control"
                                    placeholder="Leave blank to keep unchanged">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3 d-flex flex-column align-items-start">
                                <label class="form-label fw-bold">Confirm Password:</label>
                                <input type="password" name="password_confirmation" class="form-control"
                                    placeholder="Leave blank to keep unchanged">
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid mt-3">
                        <button class="btn btn-primary dark-blue" type="submit">Update Account</button>
                    </div>
                </form>

            </div>


        </div>
    </div>
@endsection

@section('scripts')
@endsection
