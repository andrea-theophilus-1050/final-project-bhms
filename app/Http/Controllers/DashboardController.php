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
    public function index()
    {
        return view('dashboard.index')->with('title', 'Dashboard');
    }

    public function profile()
    {
        return view('user.profile')->with('user', auth()->user())->with('title', 'Profile');
    }

    // public function room()
    // {
    //     return view('dashboard.room.room')->with('title', 'Room Management');
    // }

    // public function addRoom()
    // {
    //     return view('management.add-room')->with('title', 'Add New Room');
    // }

    public function electricity_bill($date)
    {
        $previousMonth = ((new Carbon($date))->subMonth())->format('F Y');

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

        $oldIndexes = DB::table('tb_electricity_bill')
            ->join('tb_rental_room', 'tb_rental_room.rental_room_id', '=', 'tb_electricity_bill.rental_room_id')
            ->where('tb_electricity_bill.date', $previousMonth)
            ->get();

        $houseList = DB::table('tb_house')
            ->where('user_id', auth()->user()->id)
            ->get();

        // $service = Services::where('service_name', 'Electricity')->first();
        return view('dashboard.room-billing.electricity-bill', compact(['dataList', 'oldIndexes', 'date', 'houseList']))->with('title', 'Electricity bill');

        // echo $previousMonth;
    }

    public function water_bill($date)
    {
        $previousMonth = ((new Carbon($date))->subMonth())->format('F Y');

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

        $oldIndexes = DB::table('tb_water_bill')
            ->join('tb_rental_room', 'tb_rental_room.rental_room_id', '=', 'tb_water_bill.rental_room_id')
            ->where('tb_water_bill.date', $previousMonth)
            ->get();

        $houseList = DB::table('tb_house')
            ->where('user_id', auth()->user()->id)
            ->get();

        // $service = Services::where('service_name', 'Electricity')->first();
        return view('dashboard.room-billing.water-bill', compact(['dataList', 'oldIndexes', 'date', 'houseList']))->with('title', 'Water bill');
    }

    public function costs_incurred()
    {
        $dataList = CostIncurred::join('tb_rental_room', 'tb_rental_room.rental_room_id', '=', 'tb_costs_incurred.rental_room_id')
            ->join('tb_rooms', 'tb_rooms.room_id', '=', 'tb_rental_room.room_id')
            ->join('tb_house', 'tb_house.house_id', '=', 'tb_rooms.house_id')
            ->join('tb_user', 'tb_user.id', '=', 'tb_house.user_id')
            ->join('tb_main_tenants', 'tb_main_tenants.tenant_id', '=', 'tb_rental_room.tenant_id')
            ->where('tb_user.id', auth()->user()->id)
            ->select('tb_costs_incurred.price','tb_costs_incurred.date','tb_costs_incurred.reason','tb_main_tenants.fullname','tb_rooms.room_name', 'tb_house.house_name')
            ->get();
        return view('dashboard.room-billing.costs-incurred', compact(['dataList']))->with('title', 'Costs Incurred');
    }

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

    public function room_billing()
    {
        return view('dashboard.room-billing.room-billing')->with('title', 'Room Billing');
    }

    public function feedback()
    {
        return view('dashboard.feedback.feedback')->with('title', 'Feedback');
    }
}
