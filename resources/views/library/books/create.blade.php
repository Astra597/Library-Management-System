@extends('library.layout')

@section('title', 'Add Book')

@section('content')
<div class="page-header">
    <h1 class="page-title">Add New Book</h1>
</div>

<div class="card">
    <form method="POST" action="{{ route('library.books.store') }}">
        @csrf
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1rem;">
            <div class="form-group">
                <label class="form-label">Title *</label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Author *</label>
                <input type="text" name="author" class="form-control" value="{{ old('author') }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">ISBN *</label>
                <input type="text" name="isbn" class="form-control" value="{{ old('isbn') }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Publisher</label>
                <input type="text" name="publisher" class="form-control" value="{{ old('publisher') }}">
            </div>
            <div class="form-group">
                <label class="form-label">Publish Year</label>
                <input type="number" name="publish_year" class="form-control" value="{{ old('publish_year') }}" min="1000" max="2100">
            </div>
            <div class="form-group">
                <label class="form-label">Category</label>
                <div class="category-chips">
                    @foreach($categories as $category)
                        <label class="category-chip">
                            <input type="radio" name="category_id" value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'checked' : '' }}>
                            <span>{{ $category->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Quantity *</label>
                <input type="number" name="quantity" class="form-control" value="{{ old('quantity', 1) }}" min="1" required>
            </div>
            <div class="form-group" style="grid-column: 1 / -1;">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control">{{ old('description') }}</textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Cover Image URL</label>
                <input type="text" name="cover_image" class="form-control" value="{{ old('cover_image') }}" placeholder="https://...">
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Create Book</button>
            <a href="{{ route('library.books.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
