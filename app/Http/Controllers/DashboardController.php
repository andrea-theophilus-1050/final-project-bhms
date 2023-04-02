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

    public function solveFeedback(Request $request)
    {
        $btnSubmit = $request->input('btnSolve');

        switch ($btnSubmit) {
            case 'accept':
                $feedback = Feedback::find($request->input('id'));
                $feedback->status = 1;
                $feedback->save();
                return redirect()->back()->with('success', 'Feedback accepted');
                break;

            case 'reject':
                $feedback = Feedback::find($request->input('id'));
                $feedback->status = 2;
                $feedback->save();
                return redirect()->back()->with('success', 'Feedback rejected');
                break;
        }
    }
}
