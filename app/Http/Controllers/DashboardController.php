<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    // home dashboard
    public function index()
    {
        return view('dashboard.index')->with('title', 'Dashboard');
    }

    // feedback page
    public function feedback()
    {
        return view('dashboard.feedback.feedback')->with('title', 'Feedback');
    }
}
