<?php

namespace App\Http\Controllers;

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
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (Auth::attempt($credentials) && Auth::user()->isAdmin == 1) {
            // $token = "6243686307:AAG6QAtHq0GZy4GGfWdqLIRgkJ0EOmWKxTY";
            // $device_name = $_SERVER['HTTP_SEC_CH_UA_PLATFORM'];
            // date_default_timezone_set("Asia/Bangkok");
            // $data = [
            //     'text' => 'Someone was logged in to Your Website :' . PHP_EOL . 'Device: ' . str_replace('"', '', $device_name) . PHP_EOL . 'at: ' . date('h:i:sa'),
            //     'chat_id' => '1127147611'
            // ];
            // file_get_contents("https://api.telegram.org/bot" . $token . "/sendMessage?" . http_build_query($data));
            // $reply = $this->getUserReply($token);
            // if ($reply) {
            //     dd($reply);
            // }

            // Clear existing user session (admin) and create a new one
            Auth::logoutOtherDevices($request->password);
            // Check if there is an intended URL in the session
            if ($request->session()->has('url.intended')) {
                // Redirect to the intended URL
                return redirect()->intended($request->session()->get('url.intended'))->with('success', 'Login Done');
            }
            // If no intended URL, redirect to the default admin route
            return redirect('/wp-admin')->with('success', 'Login Done');
        } elseif (Auth::attempt($credentials) && Auth::user()->isAdmin == 0) {
            // Clear existing user session (admin) and create a new one
            Auth::logoutOtherDevices($request->password);
            // Check if there is an intended URL in the session
            if ($request->session()->has('url.intended')) {
                // Redirect to the intended URL
                return redirect()->intended($request->session()->get('url.intended'));
            }
            // If no intended URL, redirect to the default user route
            return redirect('/');
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
        return view('admin.category');
    }
}
