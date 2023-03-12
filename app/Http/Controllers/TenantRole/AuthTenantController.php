<?php

namespace App\Http\Controllers\TenantRole;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthTenantController extends Controller
{
    public function login()
    {
        return view('tenants-pages.login')->with('title', 'Tenant Login');
    }

    public function login_action(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('tenants')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('role.tenants.index')->with('success', 'Login successful!');
        } else {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }
    }

    public function profile()
    {
        $user = Auth::guard('tenants')->user();
        return view('tenants-pages.profile', compact(['user']))->with('title', 'Tenant Profile');
    }
}
