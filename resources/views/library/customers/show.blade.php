@extends('library.layout')

@section('title', 'Customer Details')

@section('content')
<div class="page-header">
    <h1 class="page-title">{{ $customer->name }}</h1>
    <div style="display: flex; gap: 0.5rem;">
        <a href="{{ route('library.customers.edit', $customer) }}" class="btn btn-primary">Edit</a>
        <a href="{{ route('library.customers.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>

<div class="card" style="margin-bottom: 2rem;">
    <div class="detail-grid">
        <div class="detail-item">
            <div class="detail-label">Email</div>
            <div class="detail-value">{{ $customer->email }}</div>
        </div>
        <div class="detail-item">
            <div class="detail-label">Joined</div>
            <div class="detail-value">{{ $customer->created_at->format('M d, Y') }}</div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h2 class="card-title">Borrowing History</h2>
    </div>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Book</th>
                    <th>Borrow Date</th>
                    <th>Due Date</th>
                    <th>Return Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($customer->borrowings as $borrowing)
                    <tr>
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
                    <th>Book</th>
                    <th>Reserved Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($customer->reservations as $reservation)
                    <tr>
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
                    </tr>
                @empty
                    <tr><td colspan="3" style="text-align: center; color: var(--gray);">No reservations yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection