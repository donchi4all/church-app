@extends('backend.layouts.app')

@section('title', 'Donations')

@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <!-- Basic Bootstrap Table -->
            <div class="card">
                <h5 class="card-header">Donations</h5>

                <!-- Search Form -->
                <form method="GET" action="{{ route('admin.donations.list') }}" class="mb-3">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search donations"
                            value="{{ request()->get('search') }}">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>

                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Donor Name</th>
                                <th>Email</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse ($donations as $donation)
                                <tr>
                                    <td>{{ $donation->donor_name ?? 'N/A' }}</td>
                                    <td>{{ $donation->email ?? 'N/A' }}</td>
                                    <td>{{ number_format($donation->amount, 2) }} {{ $donation->currency }}</td>
                                    <td>
                                        <span class="badge bg-label-{{ $donation->status == 'success' ? 'success' : ($donation->status == 'failed' ? 'danger' : 'warning') }} me-1">
                                            {{ ucfirst($donation->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $donation->created_at ? $donation->created_at->format('F j, Y g:i A') : 'N/A' }}</td>
                                    <td>
                                        <button class="btn btn-link text-primary p-0" type="button" data-bs-toggle="modal"
                                            data-bs-target="#donationModal-{{ $donation->id }}">
                                            View More
                                        </button>
                                    </td>
                                </tr>

                                <!-- Modal -->
                                <div class="modal fade" id="donationModal-{{ $donation->id }}" tabindex="-1" aria-labelledby="donationModalLabel-{{ $donation->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="donationModalLabel-{{ $donation->id }}">Donation Details</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Donor Name:</strong> {{ $donation->donor_name }}</p>
                                                <p><strong>Email:</strong> {{ $donation->email }}</p>
                                                <p><strong>Phone:</strong> {{ $donation->phone ?? 'N/A' }}</p>
                                                <p><strong>Amount:</strong> {{ number_format($donation->amount, 2) }} {{ $donation->currency }}</p>
                                                <p><strong>Payment Method:</strong> {{ ucfirst($donation->payment_method) }}</p>
                                                <p><strong>Transaction Reference:</strong> {{ $donation->transaction_reference ?? 'N/A' }}</p>
                                                <p><strong>Status:</strong>
                                                    <span class="badge bg-label-{{ $donation->status == 'success' ? 'success' : ($donation->status == 'failed' ? 'danger' : 'warning') }}">
                                                        {{ ucfirst($donation->status) }}
                                                    </span>
                                                </p>
                                                <p><strong>Created At:</strong> {{ optional($donation->created_at)->format('F j, Y g:i A') ?? 'N/A' }}</p>
                                                <p><strong>Updated At:</strong> {{ optional($donation->updated_at)->format('F j, Y g:i A') ?? 'N/A' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No donations found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-3">
                        {{ $donations->links('pagination::bootstrap-4') }}
                    </div>
                </div>

            </div>
            <!--/ Basic Bootstrap Table -->

            <hr class="my-12" />
        </div>


        <!-- Content wrapper -->
    @endsection
