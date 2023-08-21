<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Config as ModelsConfig;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use PSpell\Config;
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
        $config = ModelsConfig::first();
        return view('admin.setting', compact('config'));
    }
    public function adminConfig_edit(Request $request)
    {
        $config = ModelsConfig::find(1);
        $config->logo = $request->logo_;
        $config->facebook = $request->facebook_link;
        $config->instagram = $request->instagram_link;
        $config->twitter = $request->twitter_link;
        $config->telegram = $request->tele_link;
        $config->tiktok = $request->tiktok_link;
        if ($config->save()) {
            return redirect()->route('config')->with('success', 'Config updated successfully.');
        } else {
            // Update failed, show the danger alert
            return redirect()->back()->with('error', 'Failed to update. Please try again.')->withInput();
        }
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
