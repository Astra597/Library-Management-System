<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    public function index(Request $request)
    {
        $query = Borrowing::with(['user', 'book']);

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        if ($request->has('overdue') && $request->overdue === '1') {
            $query->where('status', 'borrowed')
                ->where('due_date', '<', Carbon::today());
        }

        $borrowings = $query->latest()->paginate(10);

        return view('library.borrowings.index', compact('borrowings'));
    }

    public function create()
    {
        $users = User::all();
        $availableBooks = Book::where('available_quantity', '>', 0)->with('category')->get();

        return view('library.borrowings.create', compact('users', 'availableBooks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'borrow_date' => 'required|date',
            'due_date' => 'required|date|after:borrow_date',
        ]);

        $book = Book::findOrFail($validated['book_id']);

        if ($book->available_quantity <= 0) {
            return back()->with('error', 'Book is not available.');
        }

        Borrowing::create([
            'user_id' => $validated['user_id'],
            'book_id' => $validated['book_id'],
            'borrow_date' => $validated['borrow_date'],
            'due_date' => $validated['due_date'],
            'status' => 'borrowed',
        ]);

        $book->decrement('available_quantity');

        return redirect()->route('library.borrowings.index')
            ->with('success', 'Book borrowed successfully.');
    }

    public function returnBook(Borrowing $borrowing)
    {
        if ($borrowing->status !== 'borrowed') {
            return back()->with('error', 'This book has already been returned.');
        }

        $borrowing->update([
            'return_date' => Carbon::today(),
            'status' => 'returned',
        ]);

        if ($borrowing->book) {
            $borrowing->book->increment('available_quantity');
        }

        return back()->with('success', 'Book returned successfully.');
    }

    public function destroy(Borrowing $borrowing)
    {
        if ($borrowing->status === 'borrowed' && $borrowing->book) {
            $borrowing->book->increment('available_quantity');
        }
        $borrowing->delete();

        return redirect()->route('library.borrowings.index')
            ->with('success', 'Borrowing record deleted.');
    }

    public function show(Borrowing $borrowing)
    {
        $borrowing->load(['user', 'book']);

        return view('library.borrowings.show', compact('borrowing'));
    }

    public function edit(Borrowing $borrowing)
    {
        $users = User::all();
        $books = Book::all();

        return view('library.borrowings.edit', compact('borrowing', 'users', 'books'));
    }

    public function update(Request $request, Borrowing $borrowing)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'borrow_date' => 'required|date',
            'due_date' => 'required|date|after:borrow_date',
            'return_date' => 'nullable|date',
            'status' => 'required|in:borrowed,returned,overdue',
        ]);

        $borrowing->update($validated);

        return redirect()->route('library.borrowings.index')
            ->with('success', 'Borrowing updated successfully.');
    }
}
