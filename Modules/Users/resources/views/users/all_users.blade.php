@extends('users::layouts.master')

{{-- @section('title', 'All Users') --}}
@section('title', __('All Users'))

@section('head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection

@section('content')

<!-- User Management Section -->
<div class="content-header">
    <h3>All Users</h3>
    <div>
        <button class="btn btn-success me-2" 
                data-bs-toggle="offcanvas" 
                data-bs-target="#addUserForm" 
                aria-controls="addUserForm">
            Add user
        </button>
        <button class="btn btn-outline-secondary">Bulk actions</button>
        <button class="btn btn-outline-secondary">Export users report</button>
    </div>
</div>

<!-- User List Table -->
<div class="mt-4">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $index => $user)
                <tr>
                    <td>{{ $index + 1 }}</td> <!-- Serial number starts from 1 -->
                    <td>{{ $user->firstName }}</td>
                    <td>{{ $user->lastName }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        <button class="btn btn-sm btn-primary">Edit</button>
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Success and Error Messages -->
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<!-- Sidebar for Adding a User -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="addUserForm" aria-labelledby="addUserFormLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="addUserFormLabel">Add User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form action="{{ route('auth.users.add') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="firstName" class="form-label">First Name</label>
                <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter first Name">
            </div>
            <div class="mb-3">
                <label for="lastName" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter last Name">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone number">
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select class="form-select" id="role" name="role">
                    <option value="user" selected>User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Save</button>
        </form>
    </div>
</div>

@endsection
