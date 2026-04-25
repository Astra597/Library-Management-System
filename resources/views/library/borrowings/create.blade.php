@extends('library.layout')

@section('title', 'Borrow Book')

@section('content')
<div class="page-header">
    <h1 class="page-title">Borrow Book</h1>
</div>

<div class="card">
    <form method="POST" action="{{ route('library.borrowings.store') }}">
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
                    <option value="">Select Available Book</option>
                    @foreach($availableBooks as $book)
                        <option value="{{ $book->id }}">{{ $book->title }} - {{ $book->author }} ({{ $book->available_quantity }} available)</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Borrow Date *</label>
                <input type="date" name="borrow_date" class="form-control" value="{{ date('Y-m-d') }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Due Date *</label>
                <input type="date" name="due_date" class="form-control" value="{{ date('Y-m-d', strtotime('+14 days')) }}" required>
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Borrow Book</button>
            <a href="{{ route('library.borrowings.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection