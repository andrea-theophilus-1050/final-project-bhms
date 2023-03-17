<?php

namespace App\Http\Controllers\Calculation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\CostIncurred;

class CostsIncurredController extends Controller
{
    // costs incurred page
    public function costs_incurred()
    {
        $dataList = CostIncurred::join('tb_rental_room', 'tb_rental_room.rental_room_id', '=', 'tb_costs_incurred.rental_room_id')
            ->join('tb_rooms', 'tb_rooms.room_id', '=', 'tb_rental_room.room_id')
            ->join('tb_house', 'tb_house.house_id', '=', 'tb_rooms.house_id')
            ->join('tb_user', 'tb_user.id', '=', 'tb_house.user_id')
            ->join('tb_main_tenants', 'tb_main_tenants.tenant_id', '=', 'tb_rental_room.tenant_id')
            ->where('tb_user.id', auth()->user()->id)
            ->select('tb_costs_incurred.id', 'tb_costs_incurred.price', 'tb_costs_incurred.date', 'tb_costs_incurred.reason', 'tb_main_tenants.fullname', 'tb_rooms.room_name', 'tb_house.house_name')
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

    public function costs_incurred_action(Request $request)
    {
        $rentalID = $request->input('rental_room_id');
        $price = $request->input('price');
        $reason = $request->input('reason');
        $date = $request->input('month_year');

        $costs = new CostIncurred();
        $costs->rental_room_id = $rentalID;
        $costs->price = intval(str_replace(",", "", $price));
        $costs->reason = $reason;
        $costs->date = $date;
        $costs->save();

        return redirect()->route('costs-incurred')->with('success', 'Insert data successfully');
    }

    public function update_costs_incurred($id)
    {
        $costIncurred = CostIncurred::find($id);

        $dataList = Room::join('tb_house', 'tb_house.house_id', '=', 'tb_rooms.house_id')
            ->join('tb_user', 'tb_user.id', '=', 'tb_house.user_id')
            ->join('tb_rental_room', 'tb_rental_room.room_id', '=', 'tb_rooms.room_id')
            ->join('tb_main_tenants', 'tb_main_tenants.tenant_id', '=', 'tb_rental_room.tenant_id')
            ->where('tb_user.id', auth()->user()->id)
            ->where('tb_rooms.status', 1)
            ->get();

        return view('dashboard.room-billing.update-costs-incurred', compact(['costIncurred', 'dataList']))->with('title', 'Update Costs Incurred');
    }

    public function update_costs_incurred_action(Request $request, $id)
    {
        $rentalID = $request->input('rental_room_id');
        $price = $request->input('price');
        $reason = $request->input('reason');
        $date = $request->input('month_year');

        $costs = CostIncurred::find($id);
        $costs->rental_room_id = $rentalID;
        $costs->price = intval(str_replace(",", "", $price));
        $costs->reason = $reason;
        $costs->date = $date;
        $costs->save();

        return redirect()->route('costs-incurred')->with('success', 'Update data successfully');
    }

    public function cost_incurred_delete($id)
    {
        $costs = CostIncurred::find($id);
        $costs->delete();
        return redirect()->route('costs-incurred')->with('success', 'Delete data successfully');
    }
}
