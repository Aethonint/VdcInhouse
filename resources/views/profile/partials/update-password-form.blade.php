@extends('admin.app')

@section('content')
<div class="container py-5 mt-5">
    <div class="justify-content-center">
        <div class="col-12 col-md-6">
            <div class="card shadow border-0">
                <div class="card-body bg-white p-4">
                    <h2 class="card-title mb-3">Update Password</h2>
                    <p class="text-muted mb-4">Ensure your account is using a long, random password to stay secure.</p>

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="update_password_current_password" class="form-label">Current Password</label>
                            <input id="update_password_current_password" name="current_password" type="password" class="form-control" autocomplete="current-password">
                            @error('current_password', 'updatePassword')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="update_password_password" class="form-label">New Password</label>
                            <input id="update_password_password" name="password" type="password" class="form-control" autocomplete="new-password">
                            @error('password', 'updatePassword')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="update_password_password_confirmation" class="form-label">Confirm Password</label>
                            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password">
                            @error('password_confirmation', 'updatePassword')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <button type="submit" class="btn btn-primary">Update</button>

                            @if (session('status') === 'password-updated')
                                <p class="text-success mb-0">Password Updated.</p>
                            @endif
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
