<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends Controller
{
    public function register()
    {
        return view('authFolder.register');
    }
    public function registerPost(Request $request)
    {
        $user = new User();
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->name = $request->name;
        $user->isAdmin = 1;
        $user->save();
        return back()->with('success', 'Register seccessfully!');
    }
    public function login()
    {
        return view('authFolder.login');
    }
    public function loginPost(Request $request)
    {
        $previousUrl = session('previousUrl');
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->isAdmin == 1) {
                Auth::logoutOtherDevices($request->password);
                $intendedUrl = session('url.intended');
                $redirectUrl = $intendedUrl ? $intendedUrl : '/wp-admin';
                return redirect()->intended($redirectUrl)->with('success', 'Login Done');
            } else {
                if ($previousUrl) {
                    return redirect()->intended($previousUrl);
                }
                return redirect('/')->with('success', 'Login Done');
            }
        }
        return back()
            ->withInput()
            ->withErrors(['error' => 'Invalid email or password.']);
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        Session::regenerate(true);
        return redirect()->route('login');
    }
    //page..............
    public function indexAdmin()
    {
        return view('admin.home');
    }
    public function setting()
    {
        return view('admin.setting');
    }
    public function user()
    {
        return view('admin.user');
    }
    public function page()
    {
        return view('admin.page');
    }
    public function category()
    {
        $categoies = Category::all();
        return view('admin.category', compact('categoies'));
    }
}
