@extends('users::layouts.master')

@section('title', 'All Users')

@section('content')

-- @if (session('success'))
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

    <!-- جدول المستخدمين -->
    <div class="mt-4">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>John Doe</td>
                    <td>john.doe@example.com</td>
                    <td>Admin</td>
                    <td>
                        <button class="btn btn-sm btn-primary">Edit</button>
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- نافذة جانبية لإضافة مستخدم جديد -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="addUserForm" aria-labelledby="addUserFormLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="addUserFormLabel">Add User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <!-- فورم إضافة مستخدم -->
            <form action="{{ route('auth.users.add') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="userName" class="form-label">Username</label>
                    <input type="text" class="form-control" id="userName" name="userName" placeholder="Enter username">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">الهاتف</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="ادخل رقم الهاتف">
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

    <!-- لرسائل النجاح إذا كانت موجودة -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
    <div class="alert alert-success">
        {{ session('error') }}
    </div>
@endif

{{-- @if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif --}}


@endsection
