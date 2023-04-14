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
use Illuminate\Auth\Events\Registered;
use App\Models\Services;
use App\Models\Notification;

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

            Services::create([
                'service_name' => 'Electricity',
                'price' => 0,
                'description' => 'Default and required electricity service',
                'user_id' => $user->id,
                'type_id' => 1,
            ]);
            Services::create([
                'service_name' => 'Water',
                'price' => 0,
                'description' => 'Default and required water service,',
                'user_id' => $user->id,
                'type_id' => 2,
            ]);

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
            // $request->session()->regenerate();
            $user = Auth::user();
            Auth::login($user, $remember);

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
            'email' => 'email|required|unique:tb_user',
            'confirmPassword' => 'required|same:password',
        ]);

        if (event(new Registered($user = $this->create($request->all())))) {
            Services::create([
                'service_name' => 'Electricity',
                'price' => 0,
                'description' => 'Default and required electricity service',
                'user_id' => $user->id,
                'type_id' => 1,
            ]);
            Services::create([
                'service_name' => 'Water',
                'price' => 0,
                'description' => 'Default and required water service,',
                'user_id' => $user->id,
                'type_id' => 2,
            ]);
        }

        Auth::login($user, true);

        return redirect()->route('home')->with('success', 'Registration successful!');
    }

    public function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'email' => $data['email'],
        ]);
    }


    // profile page
    public function profile()
    {
        return view('user.profile')->with('user', auth()->user())->with('title', 'Profile');
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
                    $user = User::find(auth()->user()->id);
                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->phone = $request->phone;
                    $user->dob = $request->dob;
                    $user->gender = $request->gender;

                    $generatedAvatarName = null;
                    if ($request->avatar != "") {
                        $request->validate([
                            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
                        ]);

                        $generatedAvatarName = 'avatar-' . time() . '.' . $request->avatar->extension();
                        $request->avatar->move(public_path('avatar'), $generatedAvatarName);
                    }

                    $user->avatar = $generatedAvatarName;
                    $user->save();
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

    public function clearNotification()
    {
        $notification = Notification::where('user_id', auth()->user()->id)->get();
        foreach ($notification as $item) {
            $item->delete();
        }
        return redirect()->back();
    }

    //Test export excel - need to delete
    public function exportUsers(Request $request)
    {
        return Excel::download(new ExportUser, 'users.xlsx');
    }
}
