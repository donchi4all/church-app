@extends('backend.layouts.app')

@section('title', 'Users')

@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <!-- Basic Bootstrap Table -->
            <div class="card">
                <h5 class="card-header">Users</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse($users as $user)
                                <tr>
                                    <td>
                                        <span>{{ $loop->iteration }}</span>
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }} </td>
                                    <td><span
                                            class="badge bg-label-primary me-1">{{ $user->is_admin ? 'Admin' : 'User' }}</span>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="javascript:void(0);"><i
                                                        class="bx bx-edit-alt me-1"></i> Edit</a>
                                                <a class="dropdown-item" href="javascript:void(0);"><i
                                                        class="bx bx-trash me-1"></i> Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No users found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <!--/ Basic Bootstrap Table -->

            <hr class="my-12" />

            <!-- / Content -->


            <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
    @endsection
