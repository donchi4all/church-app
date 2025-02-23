@extends('backend.layouts.app')

@section('title', 'Edit SEO Settings')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-6">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Edit SEO Settings</h5>
                    <small class="text-muted float-end">Update SEO details for a specific page</small>
                </div>
                <div class="card-body">
                    <!-- Show success message if any -->
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Edit Form -->
                    {{--
                        If you are using resource routes:
                        - For Edit: route('admin.seo.update', $seo->id)
                        - For Create: route('admin.seo.store')
                        Make sure to add @method('PUT') for update.
                    --}}
                    <form action="{{ route('seo.update', $seo->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Page Slug (e.g., 'home', 'about', 'contact') -->
                        <div class="mb-6">
                            <label class="form-label" for="page">Page Identifier (Slug)</label>
                            <input type="text" id="page" name="page" class="form-control"
                                value="{{ old('page', $seo->page) }}" readonly>
                            <small class="text-muted">This uniquely identifies the page (e.g., 'home', 'about').</small>
                        </div>

                        <!-- Title -->
                        <div class="mb-6">
                            <label class="form-label" for="title">SEO Title</label>
                            <input type="text" id="title" name="title" class="form-control"
                                value="{{ old('title', $seo->title) }}" required>
                        </div>

                        <!-- Description -->
                        <div class="mb-6">
                            <label class="form-label" for="description">Meta Description</label>
                            <textarea id="description" name="description" class="form-control" rows="3" required>{{ old('description', $seo->description) }}</textarea>
                            <small class="text-muted">Recommended ~160 characters.</small>
                        </div>

                        <!-- Keywords -->
                        <div class="mb-6">
                            <label class="form-label" for="keywords">Keywords</label>
                            <input type="text" id="keywords" name="keywords" class="form-control"
                                value="{{ old('keywords', $seo->keywords) }}" required>
                            <small class="text-muted">Comma-separated (e.g. "church, sermons, Bible").</small>
                        </div>

                        <!-- Image Upload (Open Graph / Twitter Card) -->
                        <div class="mb-6">
                            <label class="form-label" for="image">SEO Image</label>
                            <input type="file" id="image" name="image" class="form-control">
                            @if ($seo->image)
                                <img src="{{ asset('storage/' . $seo->image) }}" alt="SEO Image" width="100" class="mt-2">
                            @endif
                            <small class="text-muted">Used for Open Graph & Twitter Cards.</small>
                        </div>

                        <button type="submit" class="btn btn-primary">Update SEO</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
