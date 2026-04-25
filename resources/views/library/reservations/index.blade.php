@extends('library.layout')

@section('title', 'Reservations')

@section('content')
<div class="page-header">
    <h1 class="page-title">Reservations</h1>
    <a href="{{ route('library.reservations.create') }}" class="btn btn-primary">
        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Reserve Book
    </a>
</div>

<div class="card">
    <form method="GET" class="search-box">
        <select name="status" class="filter-select">
            <option value="">All Status</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="fulfilled" {{ request('status') == 'fulfilled' ? 'selected' : '' }}>Fulfilled</option>
            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
        </select>
        <button type="submit" class="btn btn-secondary">Filter</button>
    </form>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>User</th>
                    <th>Book</th>
                    <th>Reserved Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reservations as $reservation)
                    <tr>
                        <td><strong>{{ $reservation->user?->name ?? 'Unknown User' }}</strong></td>
                        <td>{{ $reservation->book?->title ?? 'Unknown Book' }}</td>
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
                        <td class="actions-cell">
                            @if($reservation->status == 'pending')
                                <form method="POST" action="{{ route('library.reservations.fulfill', $reservation) }}" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-primary">Fulfill</button>
                                </form>
                                <form method="POST" action="{{ route('library.reservations.cancel', $reservation) }}" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-warning">Cancel</button>
                                </form>
                            @endif
                            <a href="{{ route('library.reservations.show', $reservation) }}" class="btn btn-sm btn-secondary">View</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <p>No reservations found.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination">
        {{ $reservations->links() }}
    </div>
</div>
@endsection