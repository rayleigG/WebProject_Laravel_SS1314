<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function registerUser()
    {
        return view('authFolder.registerUser');
    }
    public function registerUserPost(Request $request)
    {
        $user = new User();
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->name = $request->name;
        $user->isAdmin = 0;
        $user->save();
        return back()->with('success', 'Register seccessfully!');
    }
}
