@extends('library.layout')

@section('title', 'Borrowings')

@section('content')
<div class="page-header">
    <h1 class="page-title">Borrowings</h1>
    <a href="{{ route('library.borrowings.create') }}" class="btn btn-primary">
        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Borrow Book
    </a>
</div>

<div class="card">
    <form method="GET" class="search-box">
        <select name="status" class="filter-select">
            <option value="">All Status</option>
            <option value="borrowed" {{ request('status') == 'borrowed' ? 'selected' : '' }}>Borrowed</option>
            <option value="returned" {{ request('status') == 'returned' ? 'selected' : '' }}>Returned</option>
            <option value="overdue" {{ request('status') == 'overdue' ? 'selected' : '' }}>Overdue</option>
        </select>
        <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
            <input type="checkbox" name="overdue" value="1" {{ request('overdue') == '1' ? 'checked' : '' }} style="width: 16px; height: 16px;">
            Overdue only
        </label>
        <button type="submit" class="btn btn-secondary">Filter</button>
    </form>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>User</th>
                    <th>Book</th>
                    <th>Borrow Date</th>
                    <th>Due Date</th>
                    <th>Return Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($borrowings as $borrowing)
                    <tr>
                        <td><strong>{{ $borrowing->user?->name ?? 'Unknown User' }}</strong></td>
                        <td>{{ $borrowing->book?->title ?? 'Unknown Book' }}</td>
                        <td>{{ $borrowing->borrow_date }}</td>
                        <td>{{ $borrowing->due_date }}</td>
                        <td>{{ $borrowing->return_date ?? '-' }}</td>
                        <td>
                            @if($borrowing->status == 'returned')
                                <span class="badge badge-success">Returned</span>
                            @elseif($borrowing->due_date < now())
                                <span class="badge badge-danger">Overdue</span>
                            @else
                                <span class="badge badge-warning">Borrowed</span>
                            @endif
                        </td>
                        <td class="actions-cell">
                            @if($borrowing->status == 'borrowed')
                                <form method="POST" action="{{ route('library.borrowings.return', $borrowing) }}" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-primary">Return</button>
                                </form>
                            @endif
                            <a href="{{ route('library.borrowings.show', $borrowing) }}" class="btn btn-sm btn-secondary">View</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                                <p>No borrowings found.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination">
        {{ $borrowings->links() }}
    </div>
</div>
@endsection