@extends('library.layout')

@section('title', 'Reservation Details')

@section('content')
<div class="page-header">
    <h1 class="page-title">Reservation Details</h1>
    <div style="display: flex; gap: 0.5rem;">
        <a href="{{ route('library.reservations.edit', $reservation) }}" class="btn btn-primary">Edit</a>
        <a href="{{ route('library.reservations.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>

<div class="card">
    <div class="detail-grid">
        <div class="detail-item">
            <div class="detail-label">User</div>
            <div class="detail-value">{{ $reservation->user?->name ?? 'Unknown User' }}</div>
        </div>
        <div class="detail-item">
            <div class="detail-label">Book</div>
            <div class="detail-value">{{ $reservation->book?->title ?? 'Unknown Book' }}</div>
        </div>
        <div class="detail-item">
            <div class="detail-label">Reserved Date</div>
            <div class="detail-value">{{ $reservation->reserved_date }}</div>
        </div>
        <div class="detail-item">
            <div class="detail-label">Status</div>
            <div class="detail-value">
                @if($reservation->status == 'pending')
                    <span class="badge badge-warning">Pending</span>
                @elseif($reservation->status == 'fulfilled')
                    <span class="badge badge-success">Fulfilled</span>
                @else
                    <span class="badge badge-secondary">Cancelled</span>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection