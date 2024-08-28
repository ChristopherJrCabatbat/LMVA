@extends('user.userLayout')

@section('title', 'Dashboard')

@section('styles-links')

@endsection

@section('modals')
    <!-- Payment Modal -->
    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Please fill-up the form to proceed</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="paymentForm">
                        <div class="mb-3">
                            <label for="payment-method" class="form-label">Select Payment Method:</label>
                            <select id="payment-method" class="form-select">
                                <option value="" disabled selected>Select a payment method</option>
                                <option value="credit-card">Credit Card</option>
                                <option value="paypal">PayPal</option>
                                <option value="bank-transfer">Bank Transfer</option>
                            </select>
                        </div>
                        {{-- <button type="submit" class="btn btn-primary">Proceed to Payment</button> --}}
                        <div class="d-grid my-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('sidebar')
    <li class="nav-item">
        <a class="nav-link side-active" href="/user/dashboard"><i class="fa-solid fa-gauge me-2"></i> Dashboard</a>
    </li>
    {{-- <hr /> --}}

    <li class="nav-item">
        <a class="nav-link" href="/user/inquire"><i class="me-2 fa-solid fa-magnifying-glass-arrow-right"></i>
            Inquire</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/user/numberInquiries"><i class="me-2 fa-solid fa-magnifying-glass-chart"></i>
            Number of
            Inquiries</a>
    </li>

@endsection

@section('main-content')
    <div class="container pt-5 d-flex flex-column gap-5">
        <div class="d-flex flex-column">

            <div class="table-responsive text-center p-3 bg-light" id="staffTable">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0"><i class="fa-solid fa-gauge me-2"></i> Dashboard</h5>

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
                            <th scope="col">Inquiry Details</th>
                            <th scope="col">Payment Method</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($inquiries as $inquiry)
                            <tr class="table-light light-border" style="border: 1px solid #03346E">
                                <td>{{ $inquiry->inquiry }}</td>
                                <td>{{ $inquiry->payment_method ?? '--' }}</td>
                                <td>
                                    @if (is_null($inquiry->response))
                                        Inquiry Sent
                                    @else
                                        <a href="#" class="status-responded" data-bs-toggle="modal"
                                            data-bs-target="#paymentModal">
                                            <i class="fa-solid fa-circle-exclamation me-2"></i>Staff Responded
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr class="table-light">
                                <td colspan="3" class="text-center">There are no inquiries.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>


                <!-- Include the Pagination Component -->
                @include('components.staff-userPagination', ['items' => $inquiries])

            </div>

        </div>
    </div>
@endsection

@section('scripts')
    @if ($inquiries->count() > 0)
        <script>
            document.getElementById('paymentForm').addEventListener('submit', function(event) {
                event.preventDefault();

                // Redirect to the dashboardResponse route after payment
                window.location.href = "{{ route('user.dashboardResponse', $inquiries->first()->id) }}";
            });
        </script>
    @endif
@endsection
