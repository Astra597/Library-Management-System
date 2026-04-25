<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $username = $credentials['username'];
        $password = $credentials['password'];

        $user = User::where('name', $username)->first();

        if ($user && Hash::check($password, $user->password)) {
            $request->session()->put('admin_logged_in', true);
            $request->session()->put('admin_username', $user->name);
            $request->session()->put('admin_user_id', $user->id);

            return redirect()->route('library.books.index')->with('success', 'Welcome back, Admin!');
        }

        return back()->with('error', 'Invalid credentials.')->withInput();
    }

    public function logout(Request $request)
    {
        $request->session()->forget('admin_logged_in');
        $request->session()->forget('admin_username');
        $request->session()->forget('admin_user_id');

        return redirect()->route('admin.login')->with('success', 'You have been logged out.');
    }
}
