<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Room;
use App\Models\CostIncurred;
use App\Models\Services;
use App\Models\Utility;
use App\Models\House;
use App\Models\Tenant;
use App\Models\RentalRoom;
use App\Models\Area;
use Carbon\Carbon;


class DashboardController extends Controller
{
    // home dashboard
    public function index()
    {
        return view('dashboard.index')->with('title', 'Dashboard');
    }

    // profile page
    public function profile()
    {
        return view('user.profile')->with('user', auth()->user())->with('title', 'Profile');
    }

    // electricity page 
    public function electricity_bill($date)
    {
        // get all rooms in the house of the user where the room is occupied
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

        // get current index if it exists
        $currentIndexes = DB::table('tb_electricity_bill')
            ->join('tb_rental_room', 'tb_rental_room.rental_room_id', '=', 'tb_electricity_bill.rental_room_id')
            ->where('tb_electricity_bill.date', $date)
            ->get();

        // get the old electricity previous month's index
        $previousMonth = ((new Carbon($date))->subMonth())->format('F Y');
        $oldIndexes = DB::table('tb_electricity_bill')
            ->join('tb_rental_room', 'tb_rental_room.rental_room_id', '=', 'tb_electricity_bill.rental_room_id')
            ->where('tb_electricity_bill.date', $previousMonth)
            ->get();

        // get all houses of the user
        $houseList = DB::table('tb_house')
            ->where('user_id', auth()->user()->id)
            ->get();

        return view('dashboard.room-billing.electricity-bill', compact(['dataList', 'oldIndexes', 'currentIndexes', 'date', 'houseList']))->with('title', 'Electricity bill');
    }

    // water bill page
    public function water_bill($date)
    {
        // get all rooms in the house of the user where the room is occupied
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

        // get current index if it exists
        $currentIndexes = DB::table('tb_water_bill')
            ->join('tb_rental_room', 'tb_rental_room.rental_room_id', '=', 'tb_water_bill.rental_room_id')
            ->where('tb_water_bill.date', $date)
            ->get();

        // get the old electricity previous month's index
        $previousMonth = ((new Carbon($date))->subMonth())->format('F Y');
        $oldIndexes = DB::table('tb_water_bill')
            ->join('tb_rental_room', 'tb_rental_room.rental_room_id', '=', 'tb_water_bill.rental_room_id')
            ->where('tb_water_bill.date', $previousMonth)
            ->get();

        // get all houses of the user
        $houseList = DB::table('tb_house')
            ->where('user_id', auth()->user()->id)
            ->get();

        return view('dashboard.room-billing.water-bill', compact(['dataList', 'oldIndexes', 'currentIndexes', 'date', 'houseList']))->with('title', 'Water bill');
    }

    // costs incurred page
    public function costs_incurred()
    {
        $dataList = CostIncurred::join('tb_rental_room', 'tb_rental_room.rental_room_id', '=', 'tb_costs_incurred.rental_room_id')
            ->join('tb_rooms', 'tb_rooms.room_id', '=', 'tb_rental_room.room_id')
            ->join('tb_house', 'tb_house.house_id', '=', 'tb_rooms.house_id')
            ->join('tb_user', 'tb_user.id', '=', 'tb_house.user_id')
            ->join('tb_main_tenants', 'tb_main_tenants.tenant_id', '=', 'tb_rental_room.tenant_id')
            ->where('tb_user.id', auth()->user()->id)
            ->select('tb_costs_incurred.price', 'tb_costs_incurred.date', 'tb_costs_incurred.reason', 'tb_main_tenants.fullname', 'tb_rooms.room_name', 'tb_house.house_name')
            ->get();
        return view('dashboard.room-billing.costs-incurred', compact(['dataList']))->with('title', 'Costs Incurred');
    }

    // add costs incurred page
    public function add_costs_incurred()
    {
        $dataList = Room::join('tb_house', 'tb_house.house_id', '=', 'tb_rooms.house_id')
            ->join('tb_user', 'tb_user.id', '=', 'tb_house.user_id')
            ->join('tb_rental_room', 'tb_rental_room.room_id', '=', 'tb_rooms.room_id')
            ->join('tb_main_tenants', 'tb_main_tenants.tenant_id', '=', 'tb_rental_room.tenant_id')
            ->where('tb_user.id', auth()->user()->id)
            ->where('tb_rooms.status', 1)
            ->get();
        // dd($dataList);
        return view('dashboard.room-billing.add-costs-incurred', compact(['dataList']))->with('title', 'Add Costs Incurred');
    }

    // room billing page
    public function room_billing()
    {
        return view('dashboard.room-billing.room-billing')->with('title', 'Room Billing');
    }

    // feedback page
    public function feedback()
    {
        return view('dashboard.feedback.feedback')->with('title', 'Feedback');
    }
}
