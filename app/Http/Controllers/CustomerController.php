<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $customers = $query->latest()->paginate(10);

        return view('library.customers.index', compact('customers'));
    }

    public function create()
    {
        return view('library.customers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('library.customers.index')
            ->with('success', 'Customer added successfully.');
    }

    public function show(User $customer)
    {
        $customer->load(['borrowings.book', 'reservations.book']);

        return view('library.customers.show', compact('customer'));
    }

    public function edit(User $customer)
    {
        return view('library.customers.edit', compact('customer'));
    }

    public function update(Request $request, User $customer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$customer->id,
        ]);

        if ($request->password) {
            $request->validate(['password' => 'string|min:8|confirmed']);
            $validated['password'] = Hash::make($request->password);
        }

        $customer->update($validated);

        return redirect()->route('library.customers.index')
            ->with('success', 'Customer updated successfully.');
    }

    public function destroy(User $customer)
    {
        if ($customer->borrowings()->where('status', 'borrowed')->exists()) {
            return back()->with('error', 'Cannot delete customer with active borrows.');
        }

        $customer->delete();

        return redirect()->route('library.customers.index')
            ->with('success', 'Customer deleted successfully.');
    }
}
