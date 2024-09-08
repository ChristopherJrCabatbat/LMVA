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
                        <select id="payment-method" class="form-select" required>
                            <option value="" disabled selected>Select a payment method</option>
                            <option value="GCash">GCash</option>
                            <option value="Maya">Maya</option>
                            <option value="PayPal">PayPal</option>
                        </select>
                    </div>
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
                        {{-- Live Search --}}
                        <form action="" class="d-flex position-relative">
                            <button class="btn-custom" type="button">
                                <i class="ms-1 fa-solid fa-magnifying-glass" style="color: #0d6efd"></i>
                            </button>
                            <input type="search" id="search-input" class="form-control-custom rounded"
                                placeholder="Search something..." autocomplete="off">
                        </form>
                    </div>
                </div>

                {{-- Display Search Results --}}
                <div id="search-results">
                    @include('user.tables.dashboard_table', ['inquiries' => $inquiries])
                </div>

            </div>

        </div>
    </div>
@endsection

@section('scripts')

@if ($inquiries->count() > 0)
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let inquiryId;

        // Capture the inquiry ID when the modal is triggered
        document.querySelectorAll('.status-responded').forEach(function(element) {
            element.addEventListener('click', function() {
                inquiryId = this.getAttribute('data-inquiry-id');
            });
        });

        // Handle form submission for payment
        document.getElementById('paymentForm').addEventListener('submit', function(event) {
            event.preventDefault();

            // Get the selected payment method
            const paymentMethod = document.getElementById('payment-method').value;

            if (paymentMethod && inquiryId) {
                // Redirect based on the selected payment method
                switch (paymentMethod) {
                    case 'GCash':
                        // Simulate GCash transaction redirection
                        alert('Redirecting to GCash...');
                        window.location.href = `{{ url('user/payment/gcash') }}/${inquiryId}`;
                        break;
                    case 'Maya':
                        // Simulate Maya transaction redirection
                        alert('Redirecting to Maya...');
                        window.location.href = `{{ url('user/payment/maya') }}/${inquiryId}`;
                        break;
                    case 'PayPal':
                        // Simulate PayPal transaction redirection
                        alert('Redirecting to PayPal...');
                        window.location.href = `{{ url('user/payment/paypal') }}/${inquiryId}`;
                        break;
                    default:
                        alert('Please select a valid payment method.');
                }
            } else {
                alert('Please select a payment method and try again.');
            }
        });
    });
</script>
@endif


    {{-- Search Script --}}
    <script>
        let debounceTimer;

        function debounce(func, delay) {
            return function(...args) {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(() => func.apply(this, args), delay);
            };
        }

        function performSearch(query) {
            fetch(`{{ route('user.dashboardSearch') }}?query=${query}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                    }
                })
                .then(response => response.text())
                .then(html => {
                    document.getElementById('search-results').innerHTML = html;
                });
        }

        document.getElementById('search-input').addEventListener('input', debounce(function() {
            let query = this.value.trim();
            if (query.length > 0) {
                performSearch(query);
            } else {
                // Optional: Handle the case when the search box is empty
                // You may need to ensure the server-side handles an empty query correctly
                fetch(`{{ route('user.dashboardSearch') }}?query=`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                        }
                    })
                    .then(response => response.text())
                    .then(html => {
                        document.getElementById('search-results').innerHTML = html;
                    });
            }
        }, 500)); // Adjust the debounce delay as needed

        document.addEventListener('click', function(e) {
            if (e.target.closest('.pagination a')) {
                e.preventDefault();
                let page = e.target.getAttribute('href').split('page=')[1];
                let query = document.getElementById('search-input').value.trim();
                fetch(`{{ route('user.dashboardSearch') }}?query=${query}&page=${page}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                        }
                    })
                    .then(response => response.text())
                    .then(html => {
                        document.getElementById('search-results').innerHTML = html;
                    });
            }
        });
    </script>

@endsection
