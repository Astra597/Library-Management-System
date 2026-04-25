@extends('library.layout')

@section('title', 'Add Customer')

@section('content')
<div class="page-header">
    <h1 class="page-title">Add New Customer</h1>
</div>

<div class="card">
    <form method="POST" action="{{ route('library.customers.store') }}">
        @csrf
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1rem;">
            <div class="form-group">
                <label class="form-label">Name *</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Email *</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Password *</label>
                <input type="password" name="password" class="form-control" required minlength="8">
            </div>
            <div class="form-group">
                <label class="form-label">Confirm Password *</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Create Customer</button>
            <a href="{{ route('library.customers.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection