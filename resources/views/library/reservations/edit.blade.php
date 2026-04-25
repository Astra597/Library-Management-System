@extends('library.layout')

@section('title', 'Edit Reservation')

@section('content')
<div class="page-header">
    <h1 class="page-title">Edit Reservation</h1>
</div>

<div class="card">
    <form method="POST" action="{{ route('library.reservations.update', $reservation) }}">
        @csrf
        @method('PUT')
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1rem;">
            <div class="form-group">
                <label class="form-label">User *</label>
                <select name="user_id" class="form-control" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $reservation->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Book *</label>
                <select name="book_id" class="form-control" required>
                    @foreach($books as $book)
                        <option value="{{ $book->id }}" {{ $reservation->book_id == $book->id ? 'selected' : '' }}>{{ $book->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Status *</label>
                <select name="status" class="form-control" required>
                    <option value="pending" {{ $reservation->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="fulfilled" {{ $reservation->status == 'fulfilled' ? 'selected' : '' }}>Fulfilled</option>
                    <option value="cancelled" {{ $reservation->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('library.reservations.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection