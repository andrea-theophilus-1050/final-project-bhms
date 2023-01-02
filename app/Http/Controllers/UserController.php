<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function login()
    {
        return view('user.login')->with('title', 'Login');
    }

    public function login_action(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->route('home')->with('success', 'Login successful!');
        }
        return back()->withErrors('errors', 'Incorrect password');
    }


    public function register()
    {
        return view('user.register')->with('title', 'Registration');
    }

    public function register_action(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:tb_user',
            'password' => 'required|min:6',
            'confirmPassword' => 'required|same:password',
        ]);

        $user = new User([
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $user->save();
        return redirect()->route('login')->with('success', 'Registration successful!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Logout successful!');
    }
}
