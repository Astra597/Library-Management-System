@extends('library.layout')

@section('title', 'Reserve Book')

@section('content')
<div class="page-header">
    <h1 class="page-title">Reserve Book</h1>
</div>

<div class="card">
    <form method="POST" action="{{ route('library.reservations.store') }}">
        @csrf
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1rem;">
            <div class="form-group">
                <label class="form-label">User *</label>
                <select name="user_id" class="form-control" required>
                    <option value="">Select User</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Book *</label>
                <select name="book_id" class="form-control" required>
                    <option value="">Select Unavailable Book</option>
                    @foreach($unavailableBooks as $book)
                        <option value="{{ $book->id }}">{{ $book->title }} - {{ $book->author }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Reserve Book</button>
            <a href="{{ route('library.reservations.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection