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
                                    <button class="btn btn-link text-primary p-0" type="button" data-bs-toggle="modal"
                                        data-bs-target="#contactModal-{{ $contact->id }}">
                                        View More
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="contactModal-{{ $contact->id }}" tabindex="-1"
                                aria-labelledby="contactModalLabel-{{ $contact->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="contactModalLabel-{{ $contact->id }}">Contact
                                                Message</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>First Name:</strong> {{ $contact->first_name }}</p>
                                            <p><strong>Last Name:</strong> {{ $contact->last_name }}</p>
                                            <p><strong>Email:</strong> {{ $contact->email }}</p>
                                            <p><strong>Message:</strong></p>
                                            <p class="border p-3 bg-light">{{ nl2br(e($contact->message)) }}</p>
                                            <p><strong>Created At:</strong>
                                                {{ optional($contact->created_at)->format('F j, Y g:i A') ?? 'N/A' }}</p>
                                            <p><strong>Updated At:</strong>
                                                {{ optional($contact->updated_at)->format('F j, Y g:i A') ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
