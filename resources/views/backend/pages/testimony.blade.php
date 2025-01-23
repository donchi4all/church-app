@extends('backend.layouts.app')

@section('title', 'Manage Testimonials')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mb-6">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Manage Testimonials</h5>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTestimonialModal">
                Add Testimonial
            </button>
        </div>
        <div class="card-body">
            <!-- Testimonials Table -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Author</th>
                        <th>Role</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($testimonials as $testimonial)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $testimonial->author }}</td>
                            <td>{{ $testimonial->role }}</td>
                            <td>{{ $testimonial->title }}</td>
                            <td><img src="{{ asset($testimonial->image) }}" alt="{{ $testimonial->title }}" width="100"></td>
                            <td>
                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editTestimonialModal-{{ $testimonial->id }}">Edit</button>
                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteTestimonialModal-{{ $testimonial->id }}">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Pagination -->
            {{-- <div class="d-flex justify-content-center">
                {{ $testimonials->links() }}
            </div> --}}
            <div class="d-flex justify-content-center mt-3">
                {{ $testimonials->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>

<!-- Add Testimonial Modal -->
<div class="modal fade" id="addTestimonialModal" tabindex="-1" aria-labelledby="addTestimonialModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('admin.setting.testimony.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTestimonialModalLabel">Add Testimonial</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="author" class="form-label">Author</label>
                        <input type="text" id="author" name="author" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="quote" class="form-label">Quote</label>
                        <textarea id="quote" name="quote" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <input type="text" id="role" name="role" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" id="title" name="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" id="image" name="image" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Testimonial</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Edit and Delete Modals for Each Testimonial -->
@foreach ($testimonials as $testimonial)
    <!-- Edit Testimonial Modal -->
    <div class="modal fade" id="editTestimonialModal-{{ $testimonial->id }}" tabindex="-1" aria-labelledby="editTestimonialModalLabel-{{ $testimonial->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('admin.setting.testimony.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editTestimonialModalLabel-{{ $testimonial->id }}">Edit Testimonial</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="author-{{ $testimonial->id }}" class="form-label">Author</label>
                            <input type="text" id="author-{{ $testimonial->id }}" name="author" class="form-control" value="{{ $testimonial->author }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="quote-{{ $testimonial->id }}" class="form-label">Quote</label>
                            <textarea id="quote-{{ $testimonial->id }}" name="quote" class="form-control" required>{{ $testimonial->quote }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="role-{{ $testimonial->id }}" class="form-label">Role</label>
                            <input type="text" id="role-{{ $testimonial->id }}" name="role" class="form-control" value="{{ $testimonial->role }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="title-{{ $testimonial->id }}" class="form-label">Title</label>
                            <input type="text" id="title-{{ $testimonial->id }}" name="title" class="form-control" value="{{ $testimonial->title }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="image-{{ $testimonial->id }}" class="form-label">Image</label>
                            <input type="file" id="image-{{ $testimonial->id }}" name="image" class="form-control">
                            @if ($testimonial->image)
                                <img src="{{ asset($testimonial->image) }}" alt="{{ $testimonial->author }}" class="img-thumbnail mt-2" width="100">
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning">Update Testimonial</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Testimonial Modal -->
    <div class="modal fade" id="deleteTestimonialModal-{{ $testimonial->id }}" tabindex="-1" aria-labelledby="deleteTestimonialModalLabel-{{ $testimonial->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('admin.setting.testimony.destroy', $testimonial->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteTestimonialModalLabel-{{ $testimonial->id }}">Delete Testimonial</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete the testimonial by "{{ $testimonial->author }}"?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endforeach
@endsection
