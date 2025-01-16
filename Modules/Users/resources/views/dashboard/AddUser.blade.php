
@extends('users::layouts.master')

@section('title', 'Add User')

@section('content')
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
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
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
@endsection