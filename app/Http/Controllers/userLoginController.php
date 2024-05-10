<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\NormalUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class userLoginController extends Controller
{
    public function index()
    {
        $users = NormalUser::all();

        return view('userLogin')->with('users', $users);
    }

    public function authenticateUser(Request $request)
    {
        Log::info('Request data', $request->all());


        $request->validate([
            'user_id' => 'required|exists:normal_user,id', // Validate that the user ID exists in the users table
        ]);

        $userId = $request->input('user_id');
        Log::info("User ID: $userId");
        $user = NormalUser::find($userId);
        Log::info("User found: " . ($user ? 'yes' : 'no'));

        // Authentication passed...
        Auth::guard('user')->login($user);
        Log::info("User logged in? " . (Auth::guard('user')->check() ? 'yes' : 'no'));

        return redirect()->route('user.inventory');
    }


    public function logout(Request $request)
    {
        Auth::guard('user')->logout();

        return redirect()->route('user.loginForm'); // Redirect to the login page
    }
}
