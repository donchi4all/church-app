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
                                <th>Email</th>
                                <th>Phone</th>
                                <th>State/Country</th>
                                <th>Request</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse ($prayerRequests as $prayerRequest)
                                <tr>
                                    @foreach (['title', 'first_name', 'middle_name', 'last_name', 'email', 'phone', 'state_country'] as $field)
                                        <td>{{ $prayerRequest->$field ?? 'N/A' }}</td>
                                    @endforeach
                                    <td>
                                        <!-- View Request Button (Triggers Modal) -->
                                        <button class="btn btn-link text-primary p-0" type="button" data-bs-toggle="modal"
                                            data-bs-target="#requestModal-{{ $prayerRequest->id }}">
                                            View Request
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="requestModal-{{ $prayerRequest->id }}" tabindex="-1"
                                            aria-labelledby="requestModalLabel-{{ $prayerRequest->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="requestModalLabel-{{ $prayerRequest->id }}">
                                                            Prayer Request Details
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="text-muted">
                                                            <strong>Name:</strong> {{ $prayerRequest->first_name }}
                                                            {{ $prayerRequest->last_name }}<br>
                                                            <strong>Email:</strong> {{ $prayerRequest->email }}<br>
                                                            <strong>Phone:</strong> {{ $prayerRequest->phone }}
                                                        </p>
                                                        <hr>
                                                        <p style="white-space: pre-line;">{{ $prayerRequest->request }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ optional($prayerRequest->created_at)->format('F j, Y g:i A') ?? 'N/A' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">No prayer requests found</td>
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
