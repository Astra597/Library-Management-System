@extends('library.layout')

@section('title', 'Edit Book')

@section('content')
<div class="page-header">
    <h1 class="page-title">Edit Book</h1>
</div>

<div class="card">
    <form method="POST" action="{{ route('library.books.update', $book) }}">
        @csrf
        @method('PUT')
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1rem;">
            <div class="form-group">
                <label class="form-label">Title *</label>
                <input type="text" name="title" class="form-control" value="{{ $book->title }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Author *</label>
                <input type="text" name="author" class="form-control" value="{{ $book->author }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">ISBN *</label>
                <input type="text" name="isbn" class="form-control" value="{{ $book->isbn }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Publisher</label>
                <input type="text" name="publisher" class="form-control" value="{{ $book->publisher }}">
            </div>
            <div class="form-group">
                <label class="form-label">Publish Year</label>
                <input type="number" name="publish_year" class="form-control" value="{{ $book->publish_year }}" min="1000" max="2100">
            </div>
            <div class="form-group">
                <label class="form-label">Category</label>
                <div class="category-chips">
                    @foreach($categories as $category)
                        <label class="category-chip">
                            <input type="radio" name="category_id" value="{{ $category->id }}" {{ $book->category_id == $category->id ? 'checked' : '' }}>
                            <span>{{ $category->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Quantity *</label>
                <input type="number" name="quantity" class="form-control" value="{{ $book->quantity }}" min="1" required>
            </div>
            <div class="form-group" style="grid-column: 1 / -1;">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control">{{ $book->description }}</textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Cover Image URL</label>
                <input type="text" name="cover_image" class="form-control" value="{{ $book->cover_image }}">
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Update Book</button>
            <a href="{{ route('library.books.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
    <div style="margin-top: 2rem; padding-top: 1rem; border-top: 1px solid var(--light);">
        <form method="POST" action="{{ route('library.books.destroy', $book) }}" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this book?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete Book</button>
        </form>
    </div>
</div>
@endsection