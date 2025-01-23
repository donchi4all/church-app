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
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Last Name</th>
                        <th>Occupation</th>
                        <th>Address</th>
                        <th>State/Country</th>
                        <th>Phone Number</th>
                        <th>Alt Phone Number</th>
                        <th>Email</th>
                        <th>Monthly Pledge</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($partnerships as $partnership)
                        <tr>
                            <td>{{ $partnership->title }}</td>
                            <td>{{ $partnership->first_name }}</td>
                            <td>{{ $partnership->middle_name ?? 'N/A' }}</td>
                            <td>{{ $partnership->last_name }}</td>
                            <td>{{ $partnership->occupation }}</td>
                            <td>{{ Str::limit($partnership->address, 50) }}</td>
                            <td>{{ $partnership->state_country }}</td>
                            <td>{{ $partnership->phone_number }}</td>
                            <td>{{ $partnership->alt_phone_number ?? 'N/A' }}</td>
                            <td>{{ $partnership->email }}</td>
                            <td>{{ number_format($partnership->monthly_pledge, 2) }}</td>
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
                            <td colspan="12" class="text-center">No partnerships found</td>
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
