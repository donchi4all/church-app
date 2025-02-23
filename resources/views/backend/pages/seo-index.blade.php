@extends('backend.layouts.app')

@section('title', 'SEO Settings')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-xl">
            <div class="card mb-6">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">All SEO Settings</h5>
                    <small class="text-muted float-end">
                        <a href="{{ route('seo.create') }}" class="btn btn-sm btn-primary">Add New SEO</a>
                    </small>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Page</th>
                                <th>Title</th>
                                <th>Keywords</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($seoSettings as $seo)
                                <tr>
                                    <td>{{ $seo->page }}</td>
                                    <td>{{ $seo->title }}</td>
                                    <td>{{ $seo->keywords }}</td>
                                    <td>{{ $seo->description }}</td>
                                    <td>
                                        <a href="{{ route('seo.edit', $seo->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('seo.destroy', $seo->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this SEO setting?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            @if ($seoSettings->isEmpty())
                                <tr>
                                    <td colspan="4">No SEO settings found.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
