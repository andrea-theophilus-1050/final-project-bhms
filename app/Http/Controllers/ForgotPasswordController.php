<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;




class ForgotPasswordController extends Controller
{
    public function index()
    {
        return view('user.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('errors', 'We cannot find a user with that email address.');
        }

        $token = Str::random(60);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        $user->notify(new ResetPasswordNotification($token));
        return back()->with('success', 'We have emailed your password reset link!');
    }

    public function resetPassword(Request $request)
    {
        // reset password function manually
        $request->validate([
            'email' => 'required|email|exists:tb_user',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $updatePassword = DB::table('password_resets')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])
            ->first();

        if (!$updatePassword) {
            return back()->withInput()->with('error', 'Invalid token!');
        } else {
            $user = User::where('email', $request->email)->first();
            $user->password = Hash::make($request->password);
            $user->setRememberToken(Str::random(60));
            $user->save();
            DB::table('password_resets')->where(['email' => $request->email])->delete();
            return redirect()->route('login')->with('message', 'Your password has been changed!');
        }
    }
}
