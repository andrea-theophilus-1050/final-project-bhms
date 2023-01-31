<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\App;


class UserController extends Controller
{
    public function googleRedirect(Request $request)
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback(Request $request)
    {
        $userData = Socialite::driver('google')->user();
        $user = User::where('email', $userData->getEmail())->where('type_login', 'google')->first();
        if ($user) {
            Auth::login($user, true);
            return redirect()->route('home', app()->getLocale());
        } else {
            $user = new User();
            $user->name = $userData->getName();
            $user->email = $userData->getEmail();
            $user->password = Hash::make($userData->getId());
            $user->type_login = 'google';
            $user->role = 'landlords';
            $user->save();
            Auth::login($user, true);
            // return redirect()->route('home', app()->getLocale());
            if (Auth::user()->role == 'landlords') {
                return redirect()->route('home', app()->getLocale())->with('success', 'Login successful!');
            } else {
                return back()->with('errors', 'You cannot access the system')->withInput($request->all());
            }
        }
    }

    public function facebookRedirect(Request $request)
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function facebookCallback(Request $request)
    {
        $userData = Socialite::driver('facebook')->user();
        $user = User::where('email', $userData->getEmail())->where('type_login', 'facebook')->first();
        if ($user) {
            Auth::login($user, true);
            return redirect()->route('home', app()->getLocale());
        } else {
            $user = new User();
            $user->name = $userData->getName();

            if ($userData->getEmail() == null) {
                $user->email = $userData->getId() . '@facebook.com';
            } else {
                $user->email = $userData->getEmail();
            }

            $user->password = Hash::make($userData->getId());
            $user->type_login = 'facebook';
            $user->role = 'landlords';
            $user->save();
            Auth::login($user, true);
            // return redirect()->route('home', app()->getLocale());
            if (Auth::user()->role == 'landlords') {
                return redirect()->route('home', app()->getLocale())->with('success', 'Login successful!');
            } else {
                return back()->with('errors', 'You cannot access the system')->withInput($request->all());
            }
        }
    }

    //function return view login
    public function login()
    {
        return view('user.login')->with('title', 'Login');
    }

    //function handle login
    public function login_action(Request $request)
    {
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password, 'type_login' => 'username'], $request->remember_me)) {
            $request->session()->regenerate();
            if ($request->remember_me) {
                Cookie::queue('username', $request->username, 60 * 24 * 30);
                Cookie::queue('password', $request->password, 60 * 24 * 30);
            }
            if (Auth::user()->role == 'landlords') {
                return redirect()->route('home', app()->getLocale())->with('success', 'Login successful!');
            } else {
                return back()->with('errors', 'You cannot access the system')->withInput($request->all());
            }
        }
        return back()->with('errors', 'Incorrect username or password')->withInput($request->all());
    }

    //function return view register
    public function register()
    {
        return view('user.register')->with('title', 'Registration');
    }

    //function handle register
    public function register_action(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required|min:6',
            'confirmPassword' => 'required|same:password',
        ]);

        $user = User::where('username', $request->username)->where('type_login', 'username')->first();
        if (!$user) {
            $user = new User([
                'username' => $request->username,
                'password' => Hash::make($request->password)
            ]);

            $user->save();
            return redirect()->route('login', app()->getLocale())->with('success', 'Registration successful!')->withInput($request->all());
        } else {
            if (App::isLocale('en')) {
                return back()->with('errors', 'Username already exists')->withInput($request->all());
            } else if (App::isLocale('chn')) {
                return back()->with('errors', '此用户名已存在')->withInput($request->all());
            } else if (App::isLocale('fra')) {
                return back()->with('errors', 'Ce nom d\'utilisateur existe déjà')->withInput($request->all());
            } else {
                return back()->with('errors', 'Tên đăng nhập đã tồn tại')->withInput($request->all());
            }
        }
    }

    //function handle logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login', app()->getLocale())->with('success', 'Logout successful!');
    }



    // public function githubRedirect(Request $request)
    // {
    //     return Socialite::driver('github')->redirect();
    // }

    // public function githubCallback(Request $request)
    // {
    //     $userData = Socialite::driver('github')->user();
    //     $user = User::where('email', $userData->getEmail())->where('type_login', 'github')->first();
    //     if ($user) {
    //         Auth::login($user, true);
    //         return redirect()->route('home');
    //     } else {
    //         $user = new User();
    //         $user->name = $userData->getName();
    //         $user->email = $userData->getEmail();
    //         $user->password = Hash::make($userData->getId());
    //         $user->type_login = 'github';
    //         $user->save();
    //         Auth::login($user, true);
    //         return redirect()->route('home', app()->getLocale());
    //     }
    // }
}
