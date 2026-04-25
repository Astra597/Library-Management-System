@extends('library.layout')

@section('title', 'Customers')

@section('content')
<div class="page-header">
    <h1 class="page-title">Customers</h1>
    <a href="{{ route('library.customers.create') }}" class="btn btn-primary">
        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Add Customer
    </a>
</div>

<div class="card">
    <form method="GET" class="search-box">
        <input type="text" name="search" placeholder="Search by name or email..." class="search-input" value="{{ request('search') }}">
        <button type="submit" class="btn btn-secondary">Search</button>
    </form>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Joined</th>
                    <th>Active Borrows</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($customers as $customer)
                    <tr>
                        <td><strong>{{ $customer->name }}</strong></td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->created_at->format('M d, Y') }}</td>
                        <td>
                            @php $activeBorrows = $customer->borrowings()->where('status', 'borrowed')->count(); @endphp
                            @if($activeBorrows > 0)
                                <span class="badge badge-warning">{{ $activeBorrows }}</span>
                            @else
                                <span class="badge badge-success">0</span>
                            @endif
                        </td>
                        <td class="actions-cell">
                            <a href="{{ route('library.customers.show', $customer) }}" class="btn btn-sm btn-secondary">View</a>
                            <a href="{{ route('library.customers.edit', $customer) }}" class="btn btn-sm btn-primary">Edit</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <p>No customers found. Add your first customer!</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination">
        {{ $customers->links() }}
    </div>
</div>
@endsection