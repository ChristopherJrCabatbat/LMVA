@extends('user.userLayout')

@section('title', 'User Inquire')

@section('styles-links')

@endsection

@section('sidebar')
    <li class="nav-item">
        <a class="nav-link" href="/user/dashboard"><i class="fa-solid fa-gauge me-2"></i> Dashboard</a>
    </li>
    {{-- <hr /> --}}

    <li class="nav-item">
        <a class="nav-link" href="/user/inquire"><i class="me-2 fa-solid fa-magnifying-glass-arrow-right"></i>
            Inquire</a>
    </li>

    <li class="nav-item">
        <a class="nav-link side-active" href="/user/numberInquiries"><i class="me-2 fa-solid fa-magnifying-glass-chart"></i>
            Number of
            Inquiries</a>
    </li>


@endsection

@section('main-content')
    <div class="container pt-5 d-flex flex-column gap-5">
        <div class="d-flex flex-column">

            <div class="table-responsive text-center p-3 bg-light" id="staffTable">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0"><i class="fa-solid fa-magnifying-glass-chart me-2"></i> Number of Inquiries</h5>

                    <div class="d-flex gap-4">
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
                            <th>No.</th>
                            <th scope="col">Inquiry Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @forelse ($users as $user) --}}
                        @forelse ($users as $index => $user)
                            <tr class="table-light light-border" style="border: 1px solid #03346E">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $user->first_name }}</td>
                            </tr>
                        @empty
                            <tr class="table-light">
                                <td colspan="6" class="text-center">There are no inquiries.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Include the Pagination Component -->
                @include('components.staff-userPagination', ['items' => $users])

            </div>

        </div>
    </div>
@endsection

@section('scripts')
@endsection
