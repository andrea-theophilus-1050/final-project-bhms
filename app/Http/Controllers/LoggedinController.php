<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoggedinController extends Controller
{
    public function index()
    {
        if(Auth::check() == false) {
            return redirect()->route('login')->with('fail', 'You must be logged in');
        }
        else{
            return view('dashboard.index')->with('title', 'Logged In');
        }

    }
}
