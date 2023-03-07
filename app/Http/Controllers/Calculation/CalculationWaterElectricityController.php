<?php

namespace App\Http\Controllers\Calculation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Services;
use App\Models\Electricity;
use App\Models\Water;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\CostIncurred;

class CalculationWaterElectricityController extends Controller
{
    public function electricity_insert(Request $request)
    {
        $rentalRoomID = $request->input('rentalRoomID');
        $oldIndexElectricity = $request->input('oldIndex_electric');
        $newIndexElectricity = $request->input('newIndex_electric');
        $date = $request->input('date');

        $data = [];

        for ($i = 0; $i < count($rentalRoomID); $i++) {
            $data[] = [
                'rental_room_id' => $rentalRoomID[$i],
                'old_electricity_index' => $oldIndexElectricity[$i],
                'new_electricity_index' => $newIndexElectricity[$i],
                'date' => $date,
            ];
        }

        Electricity::insert($data);
        return redirect()->back()->with('success', 'Insert data successfully');

        // dd($request->all());
    }

    public function electricity_filter(Request $request)
    {
        // $date = $request->input('month-filter');
        // $previousMonth = ((new Carbon($date))->subMonth())->format('F Y');

        // $dataList = DB::table('tb_rooms')
        //     ->join('tb_house', 'tb_house.house_id', '=', 'tb_rooms.house_id')
        //     ->join('tb_user', 'tb_user.id', '=', 'tb_house.user_id')
        //     ->join('tb_services_used', 'tb_services_used.room_id', '=', 'tb_rooms.room_id')
        //     ->join('tb_services', 'tb_services.service_id', '=', 'tb_services_used.service_id')
        //     ->join('tb_type_service', 'tb_type_service.type_id', '=', 'tb_services.type_id')
        //     ->join('tb_rental_room', 'tb_rental_room.room_id', '=', 'tb_rooms.room_id')
        //     ->join('tb_main_tenants', 'tb_main_tenants.tenant_id', '=', 'tb_rental_room.tenant_id')
        //     ->where('tb_user.id', auth()->user()->id)
        //     ->where('tb_rooms.status', 1)
        //     ->where('tb_type_service.type_name', 'Electricity')
        //     ->where('tb_house.house_id', $request->input('house-filter'))
        //     ->get();

        // $oldIndexes = DB::table('tb_electricity_bill')
        //     ->join('tb_rental_room', 'tb_rental_room.rental_room_id', '=', 'tb_electricity_bill.rental_room_id')
        //     ->where('tb_electricity_bill.date', $previousMonth)
        //     ->get();

        // $houseList = DB::table('tb_house')
        //     ->where('user_id', auth()->user()->id)
        //     ->get();

        // // $service = Services::where('service_name', 'Electricity')->first();
        // return view('dashboard.room-billing.electricity-bill', compact(['dataList', 'oldIndexes', 'date', 'houseList']))->with('title', 'Electricity bill');
    }

    public function water_insert(Request $request)
    {
        $rentalRoomID = $request->input('rentalRoomID');
        $oldIndexWater = $request->input('oldIndex_water');
        $newIndexWater = $request->input('newIndex_water');
        $date = $request->input('date');

        $data = [];

        for ($i = 0; $i < count($rentalRoomID); $i++) {
            $data[] = [
                'rental_room_id' => $rentalRoomID[$i],
                'old_water_index' => $oldIndexWater[$i],
                'new_water_index' => $newIndexWater[$i],
                'date' => $date,
            ];
        }

        Water::insert($data);
        return redirect()->back()->with('success', 'Insert data successfully');

        // dd($request->all());
    }

    public function costs_incurred_action(Request $request)
    {
        $rentalID = $request->input('rental_room_id');
        $price = $request->input('price');
        $reason = $request->input('reason');
        $date = $request->input('month_year');

        $costs = new CostIncurred();
        $costs->rental_room_id = $rentalID;
        $costs->price = $price;
        $costs->reason = $reason;
        $costs->date = $date;
        $costs->save();

        return redirect()->route('costs-incurred')->with('success', 'Insert data successfully');
    }
}
