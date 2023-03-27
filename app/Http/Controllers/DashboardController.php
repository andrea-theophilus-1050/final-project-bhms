<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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
        $feedbacks = Feedback::orderBy('created_at', 'desc')->orderBy('status', 'desc')->paginate(10);
        return view('dashboard.feedback.feedback', compact(['feedbacks']))->with('title', 'Feedback');
    }
}
