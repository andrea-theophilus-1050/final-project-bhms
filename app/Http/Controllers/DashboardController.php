<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\RoomBilling;
use App\Models\Room;

class DashboardController extends Controller
{
    // home dashboard
    public function index()
    {
        $revenueByMonth = DB::table('tb_revenue')
            ->select(DB::raw("date as month"), DB::raw('SUM(total_price) as total_price'))
            ->where('date', 'LIKE', '% ' . date('Y') . '%')
            ->groupBy('month')
            ->get();

        $unpaidBill = RoomBilling::join('tb_rental_room', 'tb_rental_room.rental_room_id', '=', 'tb_room_billing.rental_room_id')
            ->join('tb_main_tenants', 'tb_main_tenants.tenant_id', '=', 'tb_rental_room.tenant_id')
            ->join('tb_rooms', 'tb_rooms.room_id', '=', 'tb_rental_room.room_id')
            ->join('tb_house', 'tb_house.house_id', '=', 'tb_rooms.house_id')
            ->where('tb_house.user_id', auth()->user()->id)
            ->where('tb_room_billing.status', '!=', 1)->get();

        $totalRooms = Room::join('tb_house', 'tb_house.house_id', '=', 'tb_rooms.house_id')
            ->where('tb_house.user_id', auth()->user()->id)->count();

        $occupiedRooms = Room::join('tb_house', 'tb_house.house_id', '=', 'tb_rooms.house_id')
            ->where('tb_house.user_id', auth()->user()->id)
            ->where('tb_rooms.status', 1)->count();

        $percentOccupiedRooms = number_format((($occupiedRooms / $totalRooms) * 100), 0);

        return view('dashboard.index', compact(['revenueByMonth', 'unpaidBill', 'percentOccupiedRooms']))->with('title', 'Dashboard');

        // dd($totalPrice);
        // dd($totalPrice);
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
                $feedback->response = $request->input('response');
                $feedback->save();
                return redirect()->back()->with('success', 'Feedback accepted');
                break;

            case 'reject':
                $feedback = Feedback::find($request->input('id'));
                $feedback->status = 2;
                $feedback->response = $request->input('response');
                $feedback->save();
                return redirect()->back()->with('success', 'Feedback rejected');
                break;
        }
    }
}
