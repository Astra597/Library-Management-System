@extends('library.layout')

@section('title', 'Books')

@section('content')
<div class="page-header">
    <h1 class="page-title">Books</h1>
    <a href="{{ route('library.books.create') }}" class="btn btn-primary">
        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Add New Book
    </a>
</div>

<div class="card">
    <form method="GET" class="search-box">
        <input type="text" name="search" placeholder="Search by title, author, or ISBN..." class="search-input" value="{{ request('search') }}">
        <select name="category" class="filter-select">
            <option value="">All Categories</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
            <input type="checkbox" name="available" value="1" {{ request('available') == '1' ? 'checked' : '' }} style="width: 16px; height: 16px;">
            Available only
        </label>
        <button type="submit" class="btn btn-secondary">Search</button>
    </form>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>ISBN</th>
                    <th>Category</th>
                    <th>Availability</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books as $book)
                    <tr>
                        <td><strong>{{ $book->title }}</strong></td>
                        <td>{{ $book->author }}</td>
                        <td><code style="background: var(--light); padding: 2px 6px; border-radius: 4px; font-size: 0.75rem;">{{ $book->isbn }}</code></td>
                        <td>
                            @if($book->category)
                                <span class="badge badge-info">{{ $book->category?->name ?? 'Uncategorized' }}</span>
                            @else
                                <span class="badge badge-secondary">-</span>
                            @endif
                        </td>
                        <td>
                            @if($book->available_quantity > 0)
                                <span class="badge badge-success">{{ $book->available_quantity }} / {{ $book->quantity }}</span>
                            @else
                                <span class="badge badge-danger">Out of Stock</span>
                            @endif
                        </td>
                        <td class="actions-cell">
                            <a href="{{ route('library.books.show', $book) }}" class="btn btn-sm btn-secondary">View</a>
                            <a href="{{ route('library.books.edit', $book) }}" class="btn btn-sm btn-primary">Edit</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                                <p>No books found. Add your first book!</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination">
        {{ $books->links() }}
    </div>
</div>
@endsection
