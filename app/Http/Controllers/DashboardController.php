<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Room;
use App\Models\Services;
use App\Models\Utility;
use App\Models\House;
use App\Models\Tenant;
use App\Models\RentalRoom;
use App\Models\Area;


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

    public function utility_bill()
    {
        $rooms = Room::join('tb_house', 'tb_house.house_id', '=', 'tb_rooms.house_id')->join('tb_user', 'tb_user.id', '=', 'tb_house.user_id')->where('tb_user.id', auth()->user()->id)->where('tb_rooms.status', 1)->get();
        $service = Services::where('service_name', 'Electricity')->first();
        return view('dashboard.room-billing.utility-bill')->with('title', 'Utility bill')->with('rooms', $rooms)->with('service', $service);
    }

    public function costs_incurred()
    {
        return view('dashboard.room-billing.costs-incurred')->with('title', 'Costs Incurred');
    }

    public function room_billing()
    {
        return view('dashboard.room-billing.room-billing')->with('title', 'Room Billing');
    }

    public function feedback()
    {
        return view('dashboard.feedback.feedback')->with('title', 'Feedback');
    }
}
