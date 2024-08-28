@extends('admin.adminLayout')

@section('title', 'Add DERM')

@section('styles-links')

@endsection

@section('sidebar')
    <li class="nav-item">
        <a class="nav-link" href="/admin/dashboard"><i class="fa-solid fa-gauge me-2"></i> Dashboard</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/admin/accounts"><i class="fa-solid fa-users me-2"></i> Accounts</a>
    </li>
    <li class="nav-item">
        <a class="nav-link side-active" href="/admin/derm"><i class="fa-solid fa-notes-medical me-2"></i> DERM</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/admin/reports"><i class="fa-solid fa-newspaper me-2"></i> Reports</a>
    </li>

@endsection

@section('main-content')
    <div class="container pt-5 d-flex flex-column gap-5">
        <div class="d-flex flex-column">

            <div class="table-responsive text-center p-4 bg-light position-relative">
                <div class="position-absolute top-0 start-0 p-4">
                    <a href="{{ route('admin.derm') }}">
                        <i class="fa-solid fa-circle-left fs-2 back"></i>
                    </a>
                </div>

                <form action="{{ route('admin.dermStore') }}" method="POST">
                    @csrf
                    <h3 class="mb-3"><i class="fa-solid fa-plus me-2"></i> Add Derm</h3>

                    <div class="mb-3 d-flex align-items-start flex-column">
                        <label for="derm" class="form-label">DERM Name:</label>
                        <select autofocus class="form-select" required name="derm" id="derm" aria-label="Default select example">
                            <option value="" disabled selected>Select DERM</option>
                            <option value="BS" {{ old('derm') === 'BS' ? 'selected' : '' }}>BS</option>
                            <option value="NC" {{ old('derm') === 'NC' ? 'selected' : '' }}>NC</option>
                            <option value="JC" {{ old('derm') === 'JC' ? 'selected' : '' }}>JC</option>
                            <option value="AN" {{ old('derm') === 'AN' ? 'selected' : '' }}>AN</option>
                            <option value="JB" {{ old('derm') === 'JB' ? 'selected' : '' }}>JB</option>
                            <option value="AT" {{ old('derm') === 'AT' ? 'selected' : '' }}>AT</option>
                            <option value="JG" {{ old('derm') === 'JG' ? 'selected' : '' }}>JG</option>
                            <option value="AG" {{ old('derm') === 'AG' ? 'selected' : '' }}>AG</option>
                            <option value="SL" {{ old('derm') === 'SL' ? 'selected' : '' }}>SL</option>
                            <option value="SP" {{ old('derm') === 'SP' ? 'selected' : '' }}>SP</option>
                            <option value="VB" {{ old('derm') === 'VB' ? 'selected' : '' }}>VB</option>
                        </select>
                    </div>
                    
                    @error('derm')
                        <div class="mt-3 login-error text-start alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="d-grid my-2">
                        <button class="btn btn-primary dark-blue" type="submit">Generate QR Code</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
@endsection
