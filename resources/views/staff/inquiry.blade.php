@extends('staff.staffLayout')

@section('title', 'Inquiry')

@section('styles-links')

@endsection

@section('sidebar')
    <li class="nav-item">
        <a class="nav-link" href="/staff/patientRecord"><i class="fa-solid fa-clipboard me-2"></i> Patient Record</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/staff/scan"><i class="fa-solid fa-qrcode me-2"></i> Scan</a>
    </li>
    <li class="nav-item">
        <a class="nav-link side-active" href="#"><i class="fa-solid fa-magnifying-glass-arrow-right me-2"></i>
            Inquiry</a>
    </li>
@endsection

@section('main-content')
    <div class="container pt-5 d-flex flex-column gap-5">
        <div class="d-flex flex-column">

            <div class="table-responsive text-center p-3 bg-light" id="staffTable">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0"><i class="fa-solid fa-magnifying-glass-arrow-right me-2"></i> Inquiries</h5>

                    <div class="d-flex gap-4">
                        {{-- <form action="dashboardAdd">
                    <button class="btn dark-blue" type="submit"><i class="fas fa-plus"></i> Add Record</button>
                </form> --}}
                        <form action="" class="d-flex">
                            <input type="search" class="form-control-custom rounded-start-custom"
                                placeholder="Search something...">
                            <button class="btn-custom dark-blue rounded-end-custom" type="submit"><i
                                    class="fa-solid fa-magnifying-glass"></i></button>
                        </form>

                    </div>
                </div>

                <table class="table table-bordered table-blue table-info rounded">
                    <thead>
                        <tr>
                            <th scope="col">Email</th>
                            <th scope="col">Contact Number</th>
                            <th scope="col">Inquiry Details</th>
                            <th scope="col">Payment Method</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr class="table-light light-border" style="border: 1px solid #03346E">
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->contact_number }}</td>
                                <td>{{ $user->first_name }}</td>
                                <td>GCash</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">There are no inquiries.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- Staff Pagination --}}
                {{-- <nav aria-label="Staff Pagination">
            <ul class="pagination justify-content-end">
            <!-- Add your pagination links here -->
            </ul>
        </nav> --}}
            </div>

        </div>
    </div>
@endsection

@section('scripts')
@endsection
