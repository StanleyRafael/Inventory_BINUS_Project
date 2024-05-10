<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminLoginController extends Controller
{
    public function index()
    {
        return view('adminLogin');
    }

    public function authenticateAdmin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');
        $admin = Admin::where('username', $credentials['username'])->first();

        if (!$admin) {
            return redirect()->back()->withErrors(['username' => 'Invalid username'])->withInput();
        }

        if (!Hash::check($credentials['password'], $admin->password)) {
            return redirect()->back()->withErrors(['password' => 'Invalid password'])->withInput();
        }

        // Authentication passed...
        Auth::guard('admin')->login($admin); // Log in the admin using the 'admin' guard

        return redirect()->route('admin.inventory'); // Redirect to admin dashboard
    }

    public function adminDashboard()
    {
        return view('adminHome'); // Return admin dashboard view
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout(); // Log out the admin using the 'admin' guard
        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate the CSRF token

        return redirect()->route('admin.login'); // Redirect to the login page
    }

}
