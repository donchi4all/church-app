@extends('backend.layouts.app')

@section('title', 'Contacts')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Contacts</h5>

            <!-- Search Form -->
            <form method="GET" action="{{ route('admin.contacts.list') }}" class="mb-4">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Search Contacts"
                        value="{{ request()->query('search') }}">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>

            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($contacts as $contact)
                            <tr>
                                <td>{{ $contact->first_name }}</td>
                                <td>{{ $contact->last_name }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ Str::limit($contact->message, 50) }}</td>
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
                                <td colspan="5" class="text-center">No contacts found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-3">
                    {{ $contacts->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
        <!--/ Basic Bootstrap Table -->

        <hr class="my-12" />
    </div>

@endsection
