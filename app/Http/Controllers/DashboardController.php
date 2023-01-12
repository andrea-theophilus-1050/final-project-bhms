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
                DB::table('tb_user')->where('id', auth()->user()->id)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                ]);
                return redirect()->route('home', app()->getLocale())->with('success', 'Profile updated successfully');
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

    // function to change password return errors if password is not correct
    public function changePassword(Request $request)
    {
        // $request->validate([
        //     'old_password' => 'required',
        //     'password' => 'required|confirmed',
        // ]);

        // $hashedPassword = auth()->user()->password;

        // if (password_verify($request->old_password, $hashedPassword)) {
        //     $user = Auth::user();
        //     $user->password = bcrypt($request->password);
        //     $user->save();
        //     return redirect()->route('home');
        // } else {
        //     return redirect()->back()->with('error', 'Old password is incorrect');
        // }

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
            return redirect()->route('update-profile', app()->getLocale())->with('success', 'Password changed successfully');
        } else {
            return redirect()->back()->with('error', 'Current password is incorrect')->withInput($request->all());
        }
    }
}
