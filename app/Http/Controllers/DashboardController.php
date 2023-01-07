<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        DB::table('tb_user')->where('id', auth()->user()->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);
        return redirect()->route('home');
    }

    public function addRoom()
    {
        return view('management.add-room')->with('title', 'Add New Room');
    }
}
