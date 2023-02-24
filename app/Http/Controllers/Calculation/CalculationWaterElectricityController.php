<?php

namespace App\Http\Controllers\Calculation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Services;

class CalculationWaterElectricityController extends Controller
{
    public function water()
    {
        return view('dashboard.calculation.water')->with('title', 'Water Calculation');
    }

    public function electric()
    {
        $rooms = Room::join('tb_house', 'tb_house.house_id', '=', 'tb_rooms.house_id')->join('tb_user', 'tb_user.id', '=', 'tb_house.user_id')->where('tb_user.id', auth()->user()->id)->get();
        $service = Services::where('service_name', 'Electricity')->first();
        return view('dashboard.calculation.electric')->with('title', 'Electricity Calculation')->with('rooms', $rooms)->with('service', $service);
    }

    public function costs_incurred()
    {
        return view('dashboard.calculation.costs-incurred')->with('title', 'Costs Incurred');
    }

    public function room_billing()
    {
        return view('dashboard.calculation.room-billing')->with('title', 'Room Billing');
    }
}
