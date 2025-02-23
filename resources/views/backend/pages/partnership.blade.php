@extends('backend.layouts.app')

@section('title', 'Partnership')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Partnerships</h5>

            <!-- Search Form -->
            <form method="GET" action="{{ route('admin.partnership') }}" class="mb-4">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Search Partnerships"
                        value="{{ request()->query('search') }}">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>

            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Name</th>
                            <th>Occupation</th>
                            <th>Monthly Pledge</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($partnerships as $partnership)
                            <tr>
                                <td>{{ $partnership->title }}</td>
                                <td>{{ $partnership->first_name }}
                                    {{ $partnership->middle_name ? $partnership->middle_name . ' ' : '' }}{{ $partnership->last_name }}
                                </td>
                                <td>{{ $partnership->occupation ?? 'N/A' }}</td>
                                <td>{{ number_format($partnership->monthly_pledge, 2) }}</td>
                                <td>{{ optional($partnership->created_at)->format('F j, Y g:i A') ?? 'N/A' }}</td>
                                <td>
                                    <button class="btn btn-link text-primary p-0" type="button" data-bs-toggle="modal"
                                        data-bs-target="#partnershipModal-{{ $partnership->id }}">
                                        View More
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="partnershipModal-{{ $partnership->id }}" tabindex="-1"
                                aria-labelledby="partnershipModalLabel-{{ $partnership->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="partnershipModalLabel-{{ $partnership->id }}">
                                                Partnership Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Full Name:</strong> {{ $partnership->first_name }}
                                                {{ $partnership->middle_name ? $partnership->middle_name . ' ' : '' }}{{ $partnership->last_name }}
                                            </p>
                                            <p><strong>Occupation:</strong> {{ $partnership->occupation ?? 'N/A' }}</p>
                                            <p><strong>Address:</strong> {{ $partnership->address }}</p>
                                            <p><strong>State/Country:</strong> {{ $partnership->state_country }}</p>
                                            <p><strong>Phone Number:</strong> {{ $partnership->phone_number }}</p>
                                            <p><strong>Alt Phone Number:</strong>
                                                {{ $partnership->alt_phone_number ?? 'N/A' }}</p>
                                            <p><strong>Email:</strong> {{ $partnership->email }}</p>
                                            <p><strong>Monthly Pledge:</strong>
                                                {{ number_format($partnership->monthly_pledge, 2) }}</p>
                                            <p><strong>Created At:</strong>
                                                {{ optional($partnership->created_at)->format('F j, Y g:i A') ?? 'N/A' }}
                                            </p>
                                            <p><strong>Updated At:</strong>
                                                {{ optional($partnership->updated_at)->format('F j, Y g:i A') ?? 'N/A' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No partnerships found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-3">
                    {{ $partnerships->links('pagination::bootstrap-4') }}
                </div>
            </div>

        </div>
        <!--/ Basic Bootstrap Table -->

        <hr class="my-12" />
    </div>

@endsection
