<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index')->with('title', 'Dashboard');
    }

    public function room()
    {
        return view('dashboard.room')->with('title', 'Room Management');
    }

    public function profile()
    {
        return view('user.profile')->with('user', auth()->user())->with('title', 'Profile');
    }

    public function updateProfile(Request $request)
    {
        switch ($request->btnSubmit) {
            case 'updateInformation':
                // check email unique
                $email = DB::table('tb_user')->where('email', $request->email)->where('id', '!=', auth()->user()->id)->first();
                // check phone unique
                $phone = DB::table('tb_user')->where('phone', $request->phone)->where('id', '!=', auth()->user()->id)->first();

                if ($phone) {
                    return redirect()->back()->with('errorProfile', 'Phone already exists')->withInput($request->all());
                } else if ($email) {
                    return redirect()->back()->with('errorProfile', 'Email already exists')->withInput($request->all());
                } else {
                    if ($request->avatar == "") {
                        DB::table('tb_user')->where('id', auth()->user()->id)->update([
                            'name' => $request->name,
                            'email' => $request->email,
                            'phone' => $request->phone,
                            'dob' => $request->dob,
                            'gender' => $request->gender
                        ]);
                    } else {
                        $request->validate([
                            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
                        ]);

                        $generatedAvatarName = 'avatar-' . time() . '.' . $request->avatar->extension();
                        $request->avatar->move(public_path('avatar'), $generatedAvatarName);

                        DB::table('tb_user')->where('id', auth()->user()->id)->update([
                            'name' => $request->name,
                            'email' => $request->email,
                            'phone' => $request->phone,
                            'dob' => $request->dob,
                            'gender' => $request->gender,
                            'avatar' => $generatedAvatarName
                        ]);
                    }
                }
                return redirect()->route('profile', app()->getLocale())->with('successProfile', 'Profile updated successfully');
                break;
            case 'changePassword':
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
                    return redirect()->route('profile', app()->getLocale())->with('success', 'Password changed successfully');
                } else {
                    return redirect()->back()->with('error', 'Current password is incorrect')->withInput($request->all());
                }
                break;
        }
    }

    public function addRoom()
    {
        return view('management.add-room')->with('title', 'Add New Room');
    }
}
