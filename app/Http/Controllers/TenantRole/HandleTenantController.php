<?php

namespace App\Http\Controllers\TenantRole;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\RoomBilling;
use App\Models\RentalRoom;

class HandleTenantController extends Controller
{
    public function index()
    {
        // $roomBillings = RoomBilling::join('tb_rental_room', 'tb_room_billing.rental_room_id', '=', 'tb_rental_room.rental_room_id')
        //     ->join('tb_main_tenants', 'tb_rental_room.tenant_id', '=', 'tb_main_tenants.tenant_id')
        //     ->join('tb_water_bill', 'tb_water_bill.rental_room_id', '=', 'tb_rental_room.rental_room_id')
        //     ->join('tb_electricity_bill', 'tb_electricity_bill.rental_room_id', '=', 'tb_rental_room.rental_room_id')
        //     ->where('tb_main_tenants.tenant_id', auth('tenants')->user()->tenant_id)
        //     ->get();

        // FIXME: CHƯA XONG
        $roomBillings = RentalRoom::with('roomBillings', 'waterBills', 'electricityBills', 'costIncurred', 'servicesUsed')
            ->where('tenant_id', auth('tenants')->user()->tenant_id)
            ->get();


        // return Pretty json
        return response()->json($roomBillings, 200, [], JSON_PRETTY_PRINT);
        // return view('tenants-pages.index')->with('title', 'Tenant Dashboard');
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
        $feedback->tenant_id = auth('tenants')->user()->tenant_id;
        $feedback->save();

        return redirect()->route('role.tenants.feedback')->with('success', 'Feedback sent successfully!');
    }

    public function updateFeedback(Request $request, $id)
    {
        $feedback = Feedback::find($id);
        $feedback->content = $request->contentFeedback;
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
