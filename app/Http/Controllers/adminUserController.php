<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\NormalUser;
use Illuminate\Http\Request;

class adminUserController extends Controller
{
    public function index()
    {
        return view('adminUser', [
            'users' => NormalUser::all()
        ]);
    }

    public function addUser(request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:normal_user,username',
        ]);

        $newUser = new NormalUser();
        $newUser->username = $request->input('username');

        $newUser->save();

        return redirect()->back();
    }

    public function deleteUser($userId)
    {
        NormalUser::destroy($userId);
        return redirect()->back()->with('success', 'User deleted successfully');
    }
}
