@extends('backend.layouts.app')

@section('title', 'Edit Upcoming Sermon')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Layout -->
        <div class="row">
            <div class="col-xl">
                <div class="card mb-6">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Edit Upcoming Sermon</h5>
                        <small class="text-muted float-end">Update sermon details</small>
                    </div>
                    <div class="card-body">
                        <!-- Show success message if any -->
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Edit Form -->
                        <form action="{{ route('admin.upcoming-sermon.update') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <!-- Title -->
                            <div class="mb-6">
                                <label class="form-label" for="title">Title</label>
                                <input type="text" id="title" name="title" class="form-control"
                                    value="{{ old('title', $sermon->title) }}" required>
                            </div>

                            <!-- Pastor -->
                            <div class="mb-6">
                                <label class="form-label" for="pastor">Pastor</label>
                                <input type="text" id="pastor" name="pastor" class="form-control"
                                    value="{{ old('pastor', $sermon->pastor) }}" required>
                            </div>

                            <!-- Date -->
                            <div class="mb-6">
                                <label class="form-label" for="date">Date</label>
                                <input type="date" id="date" name="date" class="form-control"
                                    value="{{ old('date', $sermon->date) }}" required>
                            </div>

                            <!-- Button Text -->
                            <div class="mb-6">
                                <label class="form-label" for="button_text">Button Text</label>
                                <input type="text" id="button_text" name="button_text" class="form-control"
                                    value="{{ old('button_text', $sermon->button_text) }}" required>
                            </div>

                            <!-- Button Link -->
                            <div class="mb-6">
                                <label class="form-label" for="button_link">Button Link</label>
                                <input type="url" id="button_link" name="button_link" class="form-control"
                                    value="{{ old('button_link', $sermon->button_link) }}" required>
                            </div>

                            <!-- Image Upload -->
                            <div class="mb-6">
                                <label class="form-label" for="image">Image</label>
                                <input type="file" id="image" name="image" class="form-control">
                                @if ($sermon->image)
                                    <img src="{{ asset($sermon->image) }}" alt="{{ $sermon->title }}" width="100"
                                        class="mt-2">
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary">Update Sermon</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
