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
                                <th>Currency</th>
                                <th>Payment Method</th>
                                <th>Transaction Reference</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse ($donations as $donation)
                                <tr>
                                    <td>{{ $donation->donor_name ?? 'N/A' }}</td>
                                    <td>{{ $donation->email ?? 'N/A' }}</td>
                                    <td>{{ number_format($donation->amount, 2) }}</td>
                                    <td>{{ $donation->currency }}</td>
                                    <td>{{ ucfirst($donation->payment_method) }}</td>
                                    <td>{{ $donation->transaction_reference ?? 'N/A' }}</td>
                                    <td>
                                        <span
                                            class="badge bg-label-{{ $donation->status == 'success' ? 'success' : ($donation->status == 'failed' ? 'danger' : 'warning') }} me-1">
                                            {{ ucfirst($donation->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="javascript:void(0);">
                                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                                </a>
                                                <a class="dropdown-item" href="javascript:void(0);">
                                                    <i class="bx bx-trash me-1"></i> Delete
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">No donations found</td>
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
