@extends('backend.layouts.app')

@section('title', 'Prayer Requests')

@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <!-- Basic Bootstrap Table -->
            <div class="card">
                <h5 class="card-header">Prayer Requests</h5>

                <!-- Search Form -->
                <form method="GET" action="{{ route('admin.prayer.request.list') }}" class="mb-3">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search prayer request"
                            value="{{ request()->get('search') }}">
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
                                <th>State/Country</th>
                                <th>Request</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse ($prayerRequests as $prayerRequest)
                                <tr>
                                    <td>{{ $prayerRequest->title }}</td>
                                    <td>{{ $prayerRequest->first_name }}</td>
                                    <td>{{ $prayerRequest->middle_name ?? 'N/A' }}</td>
                                    <td>{{ $prayerRequest->last_name }}</td>
                                    <td>{{ $prayerRequest->state_country }}</td>
                                    <td>{{ Str::limit($prayerRequest->request, 50) }}</td>

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
                                    <td colspan="7" class="text-center">No prayer requests found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-3">
                        {{ $prayerRequests->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
            <!--/ Basic Bootstrap Table -->

            <hr class="my-12" />
        </div>


        <!-- Content wrapper -->
    @endsection
