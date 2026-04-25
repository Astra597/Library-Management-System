<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with('category');

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%")
                  ->orWhere('isbn', 'like', "%{$search}%");
            });
        }

        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        if ($request->has('available') && $request->available === '1') {
            $query->where('available_quantity', '>', 0);
        }

        $books = $query->latest()->paginate(10);
        $categories = Category::all();

        return view('library.books.index', compact('books', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('library.books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'required|string|unique:books,isbn|max:20',
            'publisher' => 'nullable|string|max:255',
            'publish_year' => 'nullable|integer|min:1000|max:2100',
            'category_id' => 'nullable|exists:categories,id',
            'quantity' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|string|max:255',
        ]);

        $validated['available_quantity'] = $validated['quantity'];

        Book::create($validated);

        return redirect()->route('library.books.index')
            ->with('success', 'Book created successfully.');
    }

    public function show(Book $book)
    {
        $book->load(['category', 'borrowings.user', 'reservations.user']);
        return view('library.books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('library.books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'required|string|unique:books,isbn,' . $book->id . '|max:20',
            'publisher' => 'nullable|string|max:255',
            'publish_year' => 'nullable|integer|min:1000|max:2100',
            'category_id' => 'nullable|exists:categories,id',
            'quantity' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|string|max:255',
        ]);

        $validated['available_quantity'] = $validated['quantity'] - ($book->quantity - $book->available_quantity);

        $book->update($validated);

        return redirect()->route('library.books.index')
            ->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('library.books.index')
            ->with('success', 'Book deleted successfully.');
    }
}