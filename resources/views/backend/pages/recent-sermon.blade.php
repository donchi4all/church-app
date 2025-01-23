@extends('backend.layouts.app')

@section('title', 'Recent Sermons')

@section('content')
    <div class="container">
        <h1 class="mb-4">Recent Sermon Management</h1>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <!-- Add New Sermon Button -->
        <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addSermonModal">
            Add New Sermon
        </button>

        <!-- Sermons Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Pastor</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Link</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sermons as $sermon)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $sermon->title }}</td>
                        <td>{{ $sermon->pastor }}</td>
                        <td>{{ $sermon->date }}</td>
                        <td>{{ $sermon->description }}</td>
                        <td>
                            @if ($sermon->image)
                                <img src="{{ asset($sermon->image) }}" alt="{{ $sermon->title }}" width="100">
                            @else
                                No Image
                            @endif
                        </td>
                        <td><a href="{{ $sermon->link }}" target="_blank">{{ $sermon->link }}</a></td>
                        <td>
                            <!-- Edit Button -->
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#editSermonModal{{ $sermon->id }}">
                                Edit
                            </button>

                            <!-- Delete Button -->
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#deleteSermonModal{{ $sermon->id }}">
                                Delete
                            </button>
                        </td>
                    </tr>

                    <!-- Edit Sermon Modal -->
                    <div class="modal fade" id="editSermonModal{{ $sermon->id }}" tabindex="-1"
                        aria-labelledby="editSermonModalLabel{{ $sermon->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editSermonModalLabel{{ $sermon->id }}">Edit Sermon:
                                        {{ $sermon->title }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('admin.setting.recent.update', $sermon->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="title{{ $sermon->id }}" class="form-label">Title</label>
                                            <input type="text" id="title{{ $sermon->id }}" name="title"
                                                class="form-control" value="{{ $sermon->title }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="pastor{{ $sermon->id }}" class="form-label">Pastor</label>
                                            <input type="text" id="pastor{{ $sermon->id }}" name="pastor"
                                                class="form-control" value="{{ $sermon->pastor }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="date{{ $sermon->id }}" class="form-label">Date</label>
                                            <input type="date" id="date{{ $sermon->id }}" name="date"
                                                class="form-control" value="{{ $sermon->date }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="description{{ $sermon->id }}"
                                                class="form-label">Description</label>
                                            <textarea id="description{{ $sermon->id }}" name="description" class="form-control" rows="3" required>{{ $sermon->description }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="link{{ $sermon->id }}" class="form-label">Link</label>
                                            <input type="url" id="link{{ $sermon->id }}" name="link"
                                                class="form-control" value="{{ $sermon->link }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="image{{ $sermon->id }}" class="form-label">Image</label>
                                            <input type="file" id="image{{ $sermon->id }}" name="image"
                                                class="form-control">
                                            @if ($sermon->image)
                                                <img src="{{ asset($sermon->image) }}" alt="{{ $sermon->title }}"
                                                    width="100" class="mt-2">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Delete Sermon Modal -->
                    <div class="modal fade" id="deleteSermonModal{{ $sermon->id }}" tabindex="-1"
                        aria-labelledby="deleteSermonModalLabel{{ $sermon->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteSermonModalLabel{{ $sermon->id }}">Delete Sermon
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete the sermon titled
                                    "<strong>{{ $sermon->title }}</strong>"?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <form action="{{ route('admin.setting.recent.destroy', $sermon->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <tr>
                        <td colspan="8">No recent sermons found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Add Sermon Modal -->
    <div class="modal fade" id="addSermonModal" tabindex="-1" aria-labelledby="addSermonModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSermonModalLabel">Add New Sermon</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.setting.recent.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" id="title" name="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="pastor" class="form-label">Pastor</label>
                            <input type="text" id="pastor" name="pastor" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" id="date" name="date" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea id="description" name="description" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="link" class="form-label">Link</label>
                            <input type="url" id="link" name="link" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" id="image" name="image" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Add Sermon</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
