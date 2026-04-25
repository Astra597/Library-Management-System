@extends('library.layout')

@section('title', 'Edit Borrowing')

@section('content')
<div class="page-header">
    <h1 class="page-title">Edit Borrowing</h1>
</div>

<div class="card">
    <form method="POST" action="{{ route('library.borrowings.update', $borrowing) }}">
        @csrf
        @method('PUT')
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1rem;">
            <div class="form-group">
                <label class="form-label">User *</label>
                <select name="user_id" class="form-control" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $borrowing->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Book *</label>
                <select name="book_id" class="form-control" required>
                    @foreach($books as $book)
                        <option value="{{ $book->id }}" {{ $borrowing->book_id == $book->id ? 'selected' : '' }}>{{ $book->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Borrow Date *</label>
                <input type="date" name="borrow_date" class="form-control" value="{{ $borrowing->borrow_date }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Due Date *</label>
                <input type="date" name="due_date" class="form-control" value="{{ $borrowing->due_date }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Return Date</label>
                <input type="date" name="return_date" class="form-control" value="{{ $borrowing->return_date ?? '' }}">
            </div>
            <div class="form-group">
                <label class="form-label">Status *</label>
                <select name="status" class="form-control" required>
                    <option value="borrowed" {{ $borrowing->status == 'borrowed' ? 'selected' : '' }}>Borrowed</option>
                    <option value="returned" {{ $borrowing->status == 'returned' ? 'selected' : '' }}>Returned</option>
                    <option value="overdue" {{ $borrowing->status == 'overdue' ? 'selected' : '' }}>Overdue</option>
                </select>
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('library.borrowings.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection