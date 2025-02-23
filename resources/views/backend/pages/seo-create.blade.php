@extends('backend.layouts.app')

@section('title', 'SEO Settings')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5>SEO Settings</h5>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('seo.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Page Selection Dropdown -->
                    <div class="mb-3">
                        <label for="page" class="form-label">Select Page</label>
                        <select id="page" name="page" class="form-control" required>
                            <option value="">-- Select Page --</option>
                            @foreach ($pages as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Title -->
                    <div class="mb-3">
                        <label class="form-label" for="title">Title</label>
                        <input type="text" id="title" name="title" class="form-control" required>
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label class="form-label" for="description">Description</label>
                        <textarea id="description" name="description" class="form-control" rows="3"></textarea>
                    </div>

                    <!-- Keywords -->
                    <div class="mb-3">
                        <label class="form-label" for="keywords">Keywords (comma-separated)</label>
                        <input type="text" id="keywords" name="keywords" class="form-control">
                    </div>

                    <!-- Image Upload -->
                    <div class="mb-3">
                        <label class="form-label" for="image">SEO Image</label>
                        <input type="file" id="image" name="image" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary">Save SEO Settings</button>
                </form>
            </div>
        </div>
    </div>
@endsection
