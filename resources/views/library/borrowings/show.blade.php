@extends('library.layout')

@section('title', 'Borrowing Details')

@section('content')
<div class="page-header">
    <h1 class="page-title">Borrowing Details</h1>
    <div style="display: flex; gap: 0.5rem;">
        <a href="{{ route('library.borrowings.edit', $borrowing) }}" class="btn btn-primary">Edit</a>
        <a href="{{ route('library.borrowings.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>

<div class="card">
    <div class="detail-grid">
        <div class="detail-item">
            <div class="detail-label">User</div>
            <div class="detail-value">{{ $borrowing->user?->name ?? 'Unknown User' }}</div>
        </div>
        <div class="detail-item">
            <div class="detail-label">Book</div>
            <div class="detail-value">{{ $borrowing->book?->title ?? 'Unknown Book' }}</div>
        </div>
        <div class="detail-item">
            <div class="detail-label">Borrow Date</div>
            <div class="detail-value">{{ $borrowing->borrow_date }}</div>
        </div>
        <div class="detail-item">
            <div class="detail-label">Due Date</div>
            <div class="detail-value">{{ $borrowing->due_date }}</div>
        </div>
        <div class="detail-item">
            <div class="detail-label">Return Date</div>
            <div class="detail-value">{{ $borrowing->return_date ?? 'Not returned' }}</div>
        </div>
        <div class="detail-item">
            <div class="detail-label">Status</div>
            <div class="detail-value">
                @if($borrowing->status == 'returned')
                    <span class="badge badge-success">Returned</span>
                @elseif($borrowing->due_date < now())
                    <span class="badge badge-danger">Overdue</span>
                @else
                    <span class="badge badge-warning">Borrowed</span>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection