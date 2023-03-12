<?php

namespace App\Http\Controllers\TenantRole;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feedback;

class HandleTenantController extends Controller
{
    public function index()
    {
        return view('tenants-pages.index')->with('title', 'Tenant Dashboard');
    }

    public function feedback()
    {
        $feedbacks = Feedback::where('tenant_id', auth('tenants')->user()->tenant_id)->orderBy('created_at', 'desc')->orderBy('status', 'desc')->paginate(10);
        return view('tenants-pages.feedback', compact(['feedbacks']))->with('title', 'Tenant Feedback');
    }

    public function sendFeedback(Request $request)
    {

        $feedback = new Feedback();
        $feedback->content = $request->contentFeedback;
        $feedback->anonymous = $request->anonymous;
        $feedback->tenant_id = auth('tenants')->user()->tenant_id;
        $feedback->save();

        return redirect()->route('role.tenants.feedback')->with('success', 'Feedback sent successfully!');
    }

    public function updateFeedback(Request $request, $id)
    {
        $feedback = Feedback::find($id);
        $feedback->content = $request->contentFeedback;
        $feedback->anonymous = $request->anonymous;
        $feedback->created_at = now();
        $feedback->save();

        return redirect()->route('role.tenants.feedback')->with('success', 'Feedback updated successfully!');
    }

    public function deleteFeedback($id)
    {
        $feedback = Feedback::find($id);
        $feedback->delete();

        return redirect()->route('role.tenants.feedback')->with('success', 'Feedback deleted successfully!');
    }
}
