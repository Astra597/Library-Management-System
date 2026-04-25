@extends('library.layout')

@section('title', 'Book Details')

@section('content')
<div class="page-header">
    <h1 class="page-title">{{ $book->title }}</h1>
    <div style="display: flex; gap: 0.5rem;">
        <a href="{{ route('library.books.edit', $book) }}" class="btn btn-primary">Edit</a>
        <a href="{{ route('library.books.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>

<div class="card" style="margin-bottom: 2rem;">
    <div class="detail-grid">
        <div class="detail-item">
            <div class="detail-label">Author</div>
            <div class="detail-value">{{ $book->author }}</div>
        </div>
        <div class="detail-item">
            <div class="detail-label">ISBN</div>
            <div class="detail-value"><code>{{ $book->isbn }}</code></div>
        </div>
        <div class="detail-item">
            <div class="detail-label">Publisher</div>
            <div class="detail-value">{{ $book->publisher ?? '-' }}</div>
        </div>
        <div class="detail-item">
            <div class="detail-label">Publish Year</div>
            <div class="detail-value">{{ $book->publish_year ?? '-' }}</div>
        </div>
        <div class="detail-item">
            <div class="detail-label">Category</div>
            <div class="detail-value">
                @if($book->category)
                    <span class="badge badge-info">{{ $book->category?->name ?? 'Uncategorized' }}</span>
                @else
                    -
                @endif
            </div>
        </div>
        <div class="detail-item">
            <div class="detail-label">Availability</div>
            <div class="detail-value">
                @if($book->available_quantity > 0)
                    <span class="badge badge-success">{{ $book->available_quantity }} of {{ $book->quantity }} available</span>
                @else
                    <span class="badge badge-danger">Out of Stock</span>
                @endif
            </div>
        </div>
    </div>
    @if($book->description)
        <div style="margin-top: 1.5rem;">
            <div class="detail-label">Description</div>
            <p style="margin-top: 0.5rem; color: var(--gray);">{{ $book->description }}</p>
        </div>
    @endif
</div>

<div class="card">
    <div class="card-header">
        <h2 class="card-title">Borrowing History</h2>
    </div>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>User</th>
                    <th>Borrow Date</th>
                    <th>Due Date</th>
                    <th>Return Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($book->borrowings as $borrowing)
                    <tr>
                        <td>{{ $borrowing->user?->name ?? 'Unknown User' }}</td>
                        <td>{{ $borrowing->borrow_date }}</td>
                        <td>{{ $borrowing->due_date }}</td>
                        <td>{{ $borrowing->return_date ?? '-' }}</td>
                        <td>
                            @if($borrowing->status == 'returned')
                                <span class="badge badge-success">Returned</span>
                            @elseif($borrowing->status == 'overdue' || ($borrowing->due_date < now() && !$borrowing->return_date))
                                <span class="badge badge-danger">Overdue</span>
                            @else
                                <span class="badge badge-warning">Borrowed</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" style="text-align: center; color: var(--gray);">No borrowings yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="card" style="margin-top: 2rem;">
    <div class="card-header">
        <h2 class="card-title">Reservations</h2>
    </div>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>User</th>
                    <th>Reserved Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($book->reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->user?->name ?? 'Unknown User' }}</td>
                        <td>{{ $reservation->reserved_date }}</td>
                        <td>
                            @if($reservation->status == 'pending')
                                <span class="badge badge-warning">Pending</span>
                            @elseif($reservation->status == 'fulfilled')
                                <span class="badge badge-success">Fulfilled</span>
                            @else
                                <span class="badge badge-secondary">Cancelled</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="3" style="text-align: center; color: var(--gray);">No reservations yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection