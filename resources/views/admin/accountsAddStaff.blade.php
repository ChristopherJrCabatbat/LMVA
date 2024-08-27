@extends('admin.adminLayout')

@section('title', 'Add Staff Account')

@section('styles-links')
@endsection

@section('sidebar')
    <li class="nav-item">
        <a class="nav-link" href="/admin/dashboard"><i class="fa-solid fa-gauge me-2"></i> Dashboard</a>
    </li>
    <li class="nav-item">
        <a class="nav-link side-active" href="/admin/accounts"><i class="fa-solid fa-users me-2"></i> Accounts</a>
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

            <div class="table-responsive text-center p-4 bg-light">
                <div class="">
                    <h3 class="mb-3"><i class="fa-solid fa-plus me-2"></i> Add Staff</h3>

                    <form method="POST" action="{{ route('admin.accountsAddStaffStore') }}">
                        @csrf
                        {{-- Email --}}
                        <div class="mb-3 form-floating">
                            <input required type="email" autofocus
                                class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                                aria-describedby="emailHelp" placeholder="" value="{{ old('email') }}" />
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <div id="emailHelp" class="form-text text-start">
                                We'll never share your email with anyone else.
                            </div>
                            @error('email')
                                <div class="mt-3 login-error text-start alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Username --}}
                        <div class="mb-3 form-floating">
                            <input required type="text" class="form-control @error('username') is-invalid @enderror"
                                id="username" name="username" aria-describedby="emailHelp" placeholder=""
                                value="{{ old('username') }}" />
                            <label for="exampleInputEmail1" class="form-label">Username</label>
                            @error('username')
                                <div class="mt-3 login-error text-start alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- First Name --}}
                        <div class="mb-3 form-floating">
                            <input required type="text" class="form-control" id="first_name" name="first_name"
                                aria-describedby="emailHelp" placeholder="" value="{{ old('first_name') }}" />
                            <label for="exampleInputEmail1" class="form-label">First Name</label>
                        </div>

                        {{-- Last Name --}}
                        <div class="mb-3 form-floating">
                            <input required type="text" class="form-control" id="last_name" name="last_name"
                                aria-describedby="emailHelp" placeholder="" value="{{ old('last_name') }}" />
                            <label for="exampleInputEmail1" class="form-label">Last Name</label>
                        </div>

                        {{-- Contact Number --}}
                        <div class="mb-3 form-floating">
                            <input required type="tel" class="form-control" id="contact_number" name="contact_number"
                                aria-describedby="emailHelp" placeholder="" value="{{ old('contact_number') }}" pattern="[0-9+\-() ]*" title="Only numbers and certain characters are allowed" />
                            <label for="exampleInputEmail1" class="form-label">Contact Number</label>
                        </div>

                        {{-- Password --}}
                        <div class="mb-3 form-floating">
                            <input required type="password" id="password" name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                aria-describedby="passwordHelpBlock" placeholder="" />
                            <label for="inputPassword5" class="form-label">Password</label>
                            <div id="passwordHelpBlock" class="form-text text-start">
                                Your password must be at least 8 characters long.
                            </div>
                            @error('password')
                                <div class="mt-3 login-error text-start alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Confirm Password --}}
                        <div class="mb-3 form-floating">
                            <input required type="password" id="password_confirmation" name="password_confirmation"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                aria-describedby="passwordHelpBlock" placeholder="" />
                            <label for="inputPassword5" class="form-label">Confirm Password</label>
                            @error('password_confirmation')
                                <div class="mt-3 login-error text-start alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-grid mt-3">
                            <x-primary-button class="btn dark-blue">
                                {{ __('Add Staff') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
@endsection
