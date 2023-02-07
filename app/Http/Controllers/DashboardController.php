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

    public function profile()
    {
        return view('user.profile')->with('user', auth()->user())->with('title', 'Profile');
    }

    

    public function room()
    {
        return view('dashboard.room.room')->with('title', 'Room Management');
    }

    public function addRoom()
    {
        return view('management.add-room')->with('title', 'Add New Room');
    }
}
