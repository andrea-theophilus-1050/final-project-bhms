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

    public function houseArea(){
        return view('dashboard.house-area')->with('title', 'House Management');
    }

    public function room()
    {
        return view('dashboard.room')->with('title', 'Room Management');
    }
    
    public function addRoom()
    {
        return view('management.add-room')->with('title', 'Add New Room');
    }

    public function addHouse(){
        return view('management.add-house')->with('title','Add new house');
    }
}
