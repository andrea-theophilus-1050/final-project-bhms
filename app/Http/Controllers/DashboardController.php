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

    // public function utility_bill()
    // {
    //     $rooms = Room::join('tb_house', 'tb_house.house_id', '=', 'tb_rooms.house_id')->join('tb_user', 'tb_user.id', '=', 'tb_house.user_id')->where('tb_user.id', auth()->user()->id)->where('tb_rooms.status', 1)->get();
    //     $service = Services::where('service_name', 'Electricity')->first();
    //     return view('dashboard.room-billing.utility-bill')->with('title', 'Utility bill')->with('rooms', $rooms)->with('service', $service);
    // }

    public function electricity_bill()
    {
        $dataList = DB::table('tb_rooms')
            ->join('tb_house', 'tb_house.house_id', '=', 'tb_rooms.house_id')
            ->join('tb_user', 'tb_user.id', '=', 'tb_house.user_id')
            ->join('tb_services_used', 'tb_services_used.room_id', '=', 'tb_rooms.room_id')
            ->join('tb_services', 'tb_services.service_id', '=', 'tb_services_used.service_id')
            ->join('tb_type_service', 'tb_type_service.type_id', '=', 'tb_services.type_id')
            ->join('tb_rental_room', 'tb_rental_room.room_id', '=', 'tb_rooms.room_id')
            ->join('tb_main_tenants', 'tb_main_tenants.tenant_id', '=', 'tb_rental_room.tenant_id')
            ->where('tb_user.id', auth()->user()->id)
            ->where('tb_rooms.status', 1)
            ->where('tb_type_service.type_name', 'Electricity')
            ->get();
        // $service = Services::where('service_name', 'Electricity')->first();
        return view('dashboard.room-billing.electricity-bill')->with('title', 'Electricity bill')->with('dataList', $dataList);
    }

    public function water_bill()
    {
        $dataList = DB::table('tb_rooms')
            ->join('tb_house', 'tb_house.house_id', '=', 'tb_rooms.house_id')
            ->join('tb_user', 'tb_user.id', '=', 'tb_house.user_id')
            ->join('tb_services_used', 'tb_services_used.room_id', '=', 'tb_rooms.room_id')
            ->join('tb_services', 'tb_services.service_id', '=', 'tb_services_used.service_id')
            ->join('tb_type_service', 'tb_type_service.type_id', '=', 'tb_services.type_id')
            ->join('tb_rental_room', 'tb_rental_room.room_id', '=', 'tb_rooms.room_id')
            ->join('tb_main_tenants', 'tb_main_tenants.tenant_id', '=', 'tb_rental_room.tenant_id')
            ->where('tb_user.id', auth()->user()->id)
            ->where('tb_rooms.status', 1)
            ->where('tb_type_service.type_name', 'Water')
            ->get();
        // $service = Services::where('service_name', 'Electricity')->first();
        return view('dashboard.room-billing.water-bill')->with('title', 'Water bill')->with('dataList', $dataList);
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
