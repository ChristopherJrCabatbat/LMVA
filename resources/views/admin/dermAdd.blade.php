@extends('admin.adminLayout')

@section('title', 'Add DERM')

@section('styles-links')

@endsection

@section('sidebar')
    <li class="nav-item">
        <a class="nav-link" href="/admin/dashboard"><i class="fa-solid fa-gauge me-2"></i> Dashboard</a>
    </li>
    <hr />
    <li class="nav-item">
        <a class="nav-link" href="/admin/accounts"><i class="fa-solid fa-users me-2"></i> Accounts</a>
    </li>
    <li class="nav-item">
        <a class="nav-link side-active" href="#"><i class="fa-solid fa-notes-medical me-2"></i> DERM</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/admin/reports"><i class="fa-solid fa-newspaper me-2"></i> Reports</a>
    </li>

@endsection

@section('main-content')
    <div class="container pt-5 d-flex flex-column gap-5">
        <div class="container d-flex flex-column">

            <div class="table-responsive text-center p-3 bg-light">
                <form action="{{ route('admin.dermStore') }}" method="POST">
                    @csrf
                    <h3 class="mb-3"><i class="fa-solid fa-plus me-2"></i> Add Derm</h3>

                    <div class="mb-3 form-floating">
                        <input type="text" name="derm" class="form-control" id="derm" placeholder="">
                        <label for="derm" class="form-label">DERM Name</label>
                    </div>
                    <div class="d-grid my-3">
                        <button class="btn btn-primary add" type="submit">Generate QR Code</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
@endsection
