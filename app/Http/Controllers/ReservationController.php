<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Reservation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $query = Reservation::with(['user', 'book']);

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        $reservations = $query->latest()->paginate(10);

        return view('library.reservations.index', compact('reservations'));
    }

    public function create()
    {
        $users = User::all();
        $unavailableBooks = Book::with('category')->where('available_quantity', 0)->get();

        return view('library.reservations.create', compact('users', 'unavailableBooks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
        ]);

        $existingReservation = Reservation::where('user_id', $validated['user_id'])
            ->where('book_id', $validated['book_id'])
            ->where('status', 'pending')
            ->first();

        if ($existingReservation) {
            return back()->with('error', 'You already have a pending reservation for this book.');
        }

        Reservation::create([
            'user_id' => $validated['user_id'],
            'book_id' => $validated['book_id'],
            'reserved_date' => Carbon::today(),
            'status' => 'pending',
        ]);

        return redirect()->route('library.reservations.index')
            ->with('success', 'Book reserved successfully.');
    }

    public function fulfill(Reservation $reservation)
    {
        $book = $reservation->book;

        if ($book->available_quantity <= 0) {
            return back()->with('error', 'Cannot fulfill reservation - no copies available.');
        }

        $reservation->update(['status' => 'fulfilled']);

        return back()->with('success', 'Reservation fulfilled successfully.');
    }

    public function cancel(Reservation $reservation)
    {
        $reservation->update(['status' => 'cancelled']);

        return back()->with('success', 'Reservation cancelled.');
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return redirect()->route('library.reservations.index')
            ->with('success', 'Reservation deleted.');
    }

    public function show(Reservation $reservation)
    {
        $reservation->load(['user', 'book']);

        return view('library.reservations.show', compact('reservation'));
    }

    public function edit(Reservation $reservation)
    {
        $users = User::all();
        $books = Book::all();

        return view('library.reservations.edit', compact('reservation', 'users', 'books'));
    }

    public function update(Request $request, Reservation $reservation)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'status' => 'required|in:pending,fulfilled,cancelled',
        ]);

        $reservation->update($validated);

        return redirect()->route('library.reservations.index')
            ->with('success', 'Reservation updated successfully.');
    }
}
