@extends('backend.layouts.app')

@section('title', 'Edit About Us')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Edit About Us</h5>
                        <small class="text-muted">Manage content for the About Us section</small>
                    </div>
                    <div class="card-body">
                        <!-- Success Message -->
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('admin.setting.about.update') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <!-- Title -->
                            <div class="mb-4">
                                <label class="form-label" for="title">Title</label>
                                <input type="text" id="title" name="title" class="form-control"
                                    value="{{ old('title', $about->title) }}" placeholder="Enter title" required>
                            </div>

                            <!-- Description -->
                            <div class="mb-4">
                                <label class="form-label" for="description">Description</label>
                                <textarea id="description" name="description" class="form-control" rows="4"
                                    placeholder="Write about the church..." required>{{ old('description', $about->description) }}</textarea>
                            </div>

                            <!-- Button Text -->
                            <div class="mb-4">
                                <label class="form-label" for="button_text">Button Text</label>
                                <input type="text" id="button_text" name="button_text" class="form-control"
                                    value="{{ old('button_text', $about->button_text) }}" placeholder="Enter button text"
                                    required>
                            </div>

                            <!-- Button Link -->
                            <div class="mb-4">
                                <label class="form-label" for="button_link">Button Link</label>
                                <input type="url" id="button_link" name="button_link" class="form-control"
                                    value="{{ old('button_link', $about->button_link) }}" placeholder="Enter button link"
                                    required>
                            </div>

                            <!-- Images -->
                            <div class="mb-4">
                                <label class="form-label" for="images">Images</label>
                                <input type="file" id="images" name="images[]" class="form-control" multiple>
                                <div class="mt-3">
                                    @foreach (json_decode($about->images, true) as $image)
                                        <img src="{{ asset($image) }}" alt="Image" class="rounded me-2 mb-2"
                                            width="100">
                                    @endforeach
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Update About Us</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
