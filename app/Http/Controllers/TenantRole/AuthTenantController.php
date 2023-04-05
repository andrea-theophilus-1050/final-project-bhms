<?php

namespace App\Http\Controllers\TenantRole;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthTenantController extends Controller
{
    public function login()
    {
        return view('tenants-pages.login')->with('title', 'Tenant Login');
    }

    public function login_action(Request $request)
    {
        $request->validate([
            'credential' => 'required',
            'password' => 'required|min:6'
        ]);

        $credentials = [
            'password' => $request->password,
        ];

        if (filter_var($request->credential, FILTER_VALIDATE_EMAIL)) {
            $credentials['email'] = $request->credential;
        } else {
            $credentials['phone_number'] = $request->credential;
        }

        if (Auth::guard('tenants')->attempt($credentials)) {
            if (Auth::guard('tenants')->user()->status == 0) {
                Auth::guard('tenants')->logout();
                return back()->with('errors', 'Your account is not active')->withInput($request->all());
            } else {
                $request->session()->regenerate();
                return redirect()->route('role.tenants.index')->with('success', 'Login successful!');
            }
        } else {
            return back()->with('errors', 'Incorrect email or password')->withInput($request->all());
        }
    }

    public function profile()
    {
        $user = Auth::guard('tenants')->user();
        return view('tenants-pages.profile', compact(['user']))->with('title', 'Tenant Profile');
    }

    // handle update profile
    public function updateProfile(Request $request)
    {
        switch ($request->btnSubmit) {
            case 'updateInformation': // if user click button update information
                // check email unique
                // $email = DB::table('tb_user')->where('email', $request->email)->where('id', '!=', auth()->user()->id)->first();
                $email = Tenant::where('email', $request->email)->where('tenant_id', '!=', auth('tenants')->user()->tenant_id)->first();
                // check phone unique
                // $phone = DB::table('tb_user')->where('phone', $request->phone)->where('id', '!=', auth()->user()->id)->first();
                $phone = Tenant::where('phone_number', $request->phone)->where('tenant_id', '!=', auth('tenants')->user()->tenant_id)->first();

                if ($phone) {
                    return redirect()->back()->with('errorProfile', 'Phone already exists')->withInput($request->all());
                } else if ($email) {
                    return redirect()->back()->with('errorProfile', 'Email already exists')->withInput($request->all());
                } else {
                    $user = Tenant::find(auth('tenants')->user()->tenant_id);
                    $user->fullname = $request->name;
                    $user->email = $request->email;
                    $user->phone_number = $request->phone;
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
                return redirect()->route('role.tenants.profile')->with('successProfile', 'Profile updated successfully');
                break;

            case 'changePassword': // if user click button change password
                $request->validate([
                    'currentPassword' => 'required',
                    'newPassword' => 'required',
                    'confirmNewPassword' => 'required|same:newPassword',
                ]);

                $currentPassword = Hash::check($request->currentPassword, auth('tenants')->user()->password);
                if ($currentPassword) {
                    Tenant::where('tenant_id', auth('tenants')->user()->tenant_id)->update([
                        'password' => Hash::make($request->newPassword)
                    ]);
                    return redirect()->route('role.tenants.profile')->with('success', 'Password changed successfully');
                } else {
                    return redirect()->back()->with('error', 'Current password is incorrect')->withInput($request->all());
                }
                break;
        }
    }

    public function logout()
    {
        Auth::guard('tenants')->logout();
        return redirect()->route('tenant.login')->with('success', 'Logout successful!');
    }
}
