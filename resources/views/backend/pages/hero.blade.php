@extends('backend.layouts.app')

@section('title', 'Hero Management')

@section('content')
    <!-- Content wrapper -->
    <div class="container">
        <h1 class="mb-4">Hero Management</h1>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Subtitle</th>
                    <th>Image</th>
                    <th>Image2</th>
                    <th>Button Text</th>
                    <th>Button Link</th>
                    <th>YouTube Link</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($heroes as $hero)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $hero->title }}</td>
                        <td>{{ $hero->subtitle }}</td>
                        <td><img src="{{ asset($hero->image) }}" alt="{{ $hero->title }}" width="100"></td>
                        <td><img src="{{ asset($hero->image2) }}" alt="{{ $hero->title }}" width="100"></td>
                        <td>{{ $hero->button_text }}</td>
                        <td><a href="{{ $hero->button_link }}" target="_blank">{{ $hero->button_link }}</a></td>
                        <td><a href="{{ $hero->youtube }}" target="_blank">{{ $hero->youtube }}</a></td>
                        <td>
                            <!-- Trigger Edit Modal -->
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#editHeroModal{{ $hero->id }}">
                                Edit
                            </button>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editHeroModal{{ $hero->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Hero: {{ $hero->title }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('admin.setting.hero.update', $hero->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="title{{ $hero->id }}" class="form-label">Title</label>
                                            <input type="text" id="title{{ $hero->id }}" name="title"
                                                class="form-control" value="{{ $hero->title }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="subtitle{{ $hero->id }}" class="form-label">Subtitle</label>
                                            <textarea id="subtitle{{ $hero->id }}" name="subtitle" class="form-control" rows="3" required>{{ $hero->subtitle }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="button_text{{ $hero->id }}" class="form-label">Button
                                                Text</label>
                                            <input type="text" id="button_text{{ $hero->id }}" name="button_text"
                                                class="form-control" value="{{ $hero->button_text }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="button_link{{ $hero->id }}" class="form-label">Button
                                                Link</label>
                                            <input type="url" id="button_link{{ $hero->id }}" name="button_link"
                                                class="form-control" value="{{ $hero->button_link }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="youtube{{ $hero->id }}" class="form-label">YouTube Link</label>
                                            <input type="url" id="youtube{{ $hero->id }}" name="youtube"
                                                class="form-control" value="{{ $hero->youtube }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="image{{ $hero->id }}" class="form-label">Image</label>
                                            <input type="file" id="image{{ $hero->id }}" name="image"
                                                class="form-control">
                                            @if ($hero->image)
                                                <img src="{{ asset($hero->image) }}" alt="{{ $hero->title }}"
                                                    width="100" class="mt-2">
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label for="image2{{ $hero->id }}" class="form-label">Image2</label>
                                            <input type="file" id="image2{{ $hero->id }}" name="image2"
                                                class="form-control">
                                            @if ($hero->image2)
                                                <img src="{{ asset($hero->image2) }}" alt="{{ $hero->title }}"
                                                    width="100" class="mt-2">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                            Close
                                        </button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <tr>
                        <td colspan="9">No heroes found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <!-- Content wrapper -->
@endsection
