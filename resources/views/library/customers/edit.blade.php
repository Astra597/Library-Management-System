@extends('library.layout')

@section('title', 'Edit Customer')

@section('content')
<div class="page-header">
    <h1 class="page-title">Edit Customer</h1>
</div>

<div class="card">
    <form method="POST" action="{{ route('library.customers.update', $customer) }}">
        @csrf
        @method('PUT')
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1rem;">
            <div class="form-group">
                <label class="form-label">Name *</label>
                <input type="text" name="name" class="form-control" value="{{ $customer->name }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Email *</label>
                <input type="email" name="email" class="form-control" value="{{ $customer->email }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">New Password</label>
                <input type="password" name="password" class="form-control" placeholder="Leave blank to keep current">
            </div>
            <div class="form-group">
                <label class="form-label">Confirm New Password</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Update Customer</button>
            <a href="{{ route('library.customers.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
    <div style="margin-top: 2rem; padding-top: 1rem; border-top: 1px solid var(--light);">
        <form method="POST" action="{{ route('library.customers.destroy', $customer) }}" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this customer?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete Customer</button>
        </form>
    </div>
</div>
@endsection