<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\App;
use App\Exports\ExportUser;
use Maatwebsite\Excel\Facades\Excel;




class UserController extends Controller
{
    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback(Request $request)
    {
        $userData = Socialite::driver('google')->user();
        $user = User::where('email', $userData->getEmail())->where('type_login', 'google')->first();
        if ($user) {
            Auth::login($user, true);
            return redirect()->route('home');
        } else {
            $user = new User();
            $user->name = $userData->getName();
            $user->email = $userData->getEmail();
            $user->password = Hash::make($userData->getId());
            $user->type_login = 'google';
            $user->role = 'landlords';
            $user->save();
            Auth::login($user, true);
            // return redirect()->route('home');
            if (Auth::user()->role == 'landlords') {
                return redirect()->route('home')->with('success', 'Login successful!');
            } else {
                return back()->with('errors', 'You cannot access the system')->withInput($request->all());
            }
        }
    }

    public function facebookRedirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function facebookCallback(Request $request)
    {
        $userData = Socialite::driver('facebook')->user();
        $user = User::where('email', $userData->getEmail())->where('type_login', 'facebook')->first();
        if ($user) {
            Auth::login($user, true);
            return redirect()->route('home');
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
            // return redirect()->route('home');
            if (Auth::user()->role == 'landlords') {
                return redirect()->route('home')->with('success', 'Login successful!');
            } else {
                return back()->with('errors', 'You cannot access the system')->withInput($request->all());
            }
        }
    }

    //function return view login
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('home')->with('success', 'Login successful!');
        } else {
            return view('user.login')->with('title', 'Login');
        }
    }

    //function handle login
    public function login_action(Request $request)
    {
        $remember = $request->has('remember_me') || Cookie::has('remember_me');
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            // if ($request->remember_me) {
            //     Cookie::queue('username', $request->username, 60 * 24 * 30);
            //     Cookie::queue('password', $request->password, 60 * 24 * 30);
            // }
            if (Auth::user()->role == 'landlords') {
                return redirect()->route('home')->with('success', 'Login successful!');
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
            return redirect()->route('login')->with('success', 'Registration successful!')->withInput($request->all());
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

    // handle update profile
    public function updateProfile(Request $request)
    {
        switch ($request->btnSubmit) {
            case 'updateInformation': // if user click button update information
                // check email unique
                // $email = DB::table('tb_user')->where('email', $request->email)->where('id', '!=', auth()->user()->id)->first();
                $email = User::where('email', $request->email)->where('id', '!=', auth()->user()->id)->first();
                // check phone unique
                // $phone = DB::table('tb_user')->where('phone', $request->phone)->where('id', '!=', auth()->user()->id)->first();
                $phone = User::where('phone', $request->phone)->where('id', '!=', auth()->user()->id)->first();

                if ($phone) {
                    return redirect()->back()->with('errorProfile', 'Phone already exists')->withInput($request->all());
                } else if ($email) {
                    return redirect()->back()->with('errorProfile', 'Email already exists')->withInput($request->all());
                } else {
                    if ($request->avatar == "") {
                        // DB::table('tb_user')->where('id', auth()->user()->id)->update([
                        //     'name' => $request->name,
                        //     'email' => $request->email,
                        //     'phone' => $request->phone,
                        //     'dob' => $request->dob,
                        //     'gender' => $request->gender
                        // ]);
                        //update user using class User
                        $user = User::find(auth()->user()->id);
                        $user->name = $request->name;
                        $user->email = $request->email;
                        $user->phone = $request->phone;
                        $user->dob = $request->dob;
                        $user->gender = $request->gender;
                        $user->save();
                    } else {
                        $request->validate([
                            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
                        ]);

                        $generatedAvatarName = 'avatar-' . time() . '.' . $request->avatar->extension();
                        $request->avatar->move(public_path('avatar'), $generatedAvatarName);

                        // DB::table('tb_user')->where('id', auth()->user()->id)->update([
                        //     'name' => $request->name,
                        //     'email' => $request->email,
                        //     'phone' => $request->phone,
                        //     'dob' => $request->dob,
                        //     'gender' => $request->gender,
                        //     'avatar' => $generatedAvatarName
                        // ]);
                        //update user using class User
                        $user = User::find(auth()->user()->id);
                        $user->name = $request->name;
                        $user->email = $request->email;
                        $user->phone = $request->phone;
                        $user->dob = $request->dob;
                        $user->gender = $request->gender;
                        $user->avatar = $generatedAvatarName;
                        $user->save();
                    }
                }
                return redirect()->route('profile')->with('successProfile', 'Profile updated successfully');
                break;

            case 'changePassword': // if user click button change password
                $request->validate([
                    'currentPassword' => 'required',
                    'newPassword' => 'required',
                    'confirmNewPassword' => 'required|same:newPassword',
                ]);

                $currentPassword = Hash::check($request->currentPassword, auth()->user()->password);
                if ($currentPassword) {
                    User::findOrFail(Auth::user()->id)->update([
                        'password' => Hash::make($request->newPassword)
                    ]);
                    return redirect()->route('profile')->with('success', 'Password changed successfully');
                } else {
                    return redirect()->back()->with('error', 'Current password is incorrect')->withInput($request->all());
                }
                break;
        }
    }

    //function handle logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Logout successful!');
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
    //         return redirect()->route('home');
    //     }
    // }

    public function exportUsers(Request $request)
    {
        return Excel::download(new ExportUser, 'users.xlsx');
    }
}
