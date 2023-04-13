<?php

namespace App\Http\Controllers\Room;

use App\Http\Controllers\Controller;
use App\Models\Electricity;
use App\Models\Water;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Room;
use App\Models\Tenant;
use App\Models\RentalRoom;
use Carbon\Carbon;

class ReturnRoomController extends Controller
{
    public function returnRoom(Request $request)
    {
        $roomID = $request->roomID;
        $tenantID = $request->tenantID;
        $rentalID = $request->rentalID;

        $rentalRoom = RentalRoom::find($rentalID);
        $rentalRoom->status = 1;
        $rentalRoom->end_date = Carbon::now();
        $rentalRoom->save();

        $room = Room::find($roomID);
        $room->status = 0;
        $room->save();

        $tenant = Tenant::find($tenantID);
        $tenant->status = 2;
        $tenant->save();

        return redirect()->route('handle-returned-room', [$roomID, $tenantID, $rentalID]);
    }

    // public function handleReturnedRoom($roomID, $tenantID, $rentalID)
    // {
    //     $electricity = DB::table('tb_services_used')
    //         ->join('tb_services', 'tb_services.service_id', '=', 'tb_services_used.service_id')
    //         ->join('tb_type_service', 'tb_type_service.type_id', '=', 'tb_services.type_id')
    //         ->join('tb_user', 'tb_user.id', '=', 'tb_services.user_id')
    //         ->join('tb_rental_room', 'tb_rental_room.rental_room_id', '=', 'tb_services_used.rental_room_id')
    //         ->join('tb_rooms', 'tb_rooms.room_id', '=', 'tb_rental_room.room_id')
    //         ->join('tb_house', 'tb_house.house_id', '=', 'tb_rooms.house_id')
    //         ->join('tb_main_tenants', 'tb_main_tenants.tenant_id', '=', 'tb_rental_room.tenant_id')
    //         ->where('tb_services.type_id', 1)
    //         ->where('tb_house.user_id', auth()->user()->id)
    //         ->where('tb_rooms.room_id', $roomID)
    //         ->where('tb_rental_room.status', 1)
    //         ->first();

    //     $water = DB::table('tb_services_used')
    //         ->join('tb_services', 'tb_services.service_id', '=', 'tb_services_used.service_id')
    //         ->join('tb_type_service', 'tb_type_service.type_id', '=', 'tb_services.type_id')
    //         ->join('tb_user', 'tb_user.id', '=', 'tb_services.user_id')
    //         ->join('tb_rental_room', 'tb_rental_room.rental_room_id', '=', 'tb_services_used.rental_room_id')
    //         ->join('tb_rooms', 'tb_rooms.room_id', '=', 'tb_rental_room.room_id')
    //         ->join('tb_house', 'tb_house.house_id', '=', 'tb_rooms.house_id')
    //         ->join('tb_main_tenants', 'tb_main_tenants.tenant_id', '=', 'tb_rental_room.tenant_id')
    //         ->where('tb_services.type_id', 2)
    //         ->where('tb_house.user_id', auth()->user()->id)
    //         ->where('tb_rooms.room_id', $roomID)
    //         ->where('tb_rental_room.status', 1)
    //         ->first();

    //     // get current index if it exists
    //     $currentIndexes_electricity = DB::table('tb_electricity_bill')
    //         ->join('tb_rental_room', 'tb_rental_room.rental_room_id', '=', 'tb_electricity_bill.rental_room_id')
    //         ->where('tb_electricity_bill.date', now()->format('F Y'))
    //         ->get();

    //     // get current index if it exists
    //     $currentIndexes_water = DB::table('tb_water_bill')
    //         ->join('tb_rental_room', 'tb_rental_room.rental_room_id', '=', 'tb_water_bill.rental_room_id')
    //         ->where('tb_water_bill.date', now()->format('F Y'))
    //         ->get();

    //     // get the old electricity previous month's index
    //     $previousMonth = ((new Carbon(now()->format('F Y')))->subMonth())->format('F Y');

    //     $oldIndexes_electricity = DB::table('tb_electricity_bill')
    //         ->join('tb_rental_room', 'tb_rental_room.rental_room_id', '=', 'tb_electricity_bill.rental_room_id')
    //         ->where('tb_electricity_bill.date', $previousMonth)
    //         ->get();

    //     $oldIndexes_water = DB::table('tb_water_bill')
    //         ->join('tb_rental_room', 'tb_rental_room.rental_room_id', '=', 'tb_water_bill.rental_room_id')
    //         ->where('tb_water_bill.date', $previousMonth)
    //         ->get();

    //     return view('dashboard.room.returned-room.handle-return-room', compact(['electricity', 'water', 'currentIndexes_electricity', 'currentIndexes_water', 'oldIndexes_electricity', 'oldIndexes_water']))->with('title', 'Handle Returned Room');
    // }

    // public function serviceInsert(Request $request)
    // {
    //     $rentalRoomID = $request->rentalRoomID;
    //     $date = now()->format('F Y');

    //     $oldIndexElectricity = $request->oldIndex_electric;
    //     $newIndexElectricity = $request->newIndex_electric;

    //     // Check if the current month's index exists
    //     if ($oldIndexElectricity != null && $newIndexElectricity != null && $oldIndexElectricity < $newIndexElectricity) {
    //         $exists = Electricity::where('rental_room_id', $rentalRoomID)
    //             ->where('date', $date)
    //             ->first();
    //         if ($exists) {
    //             if ($exists->old_electricity_index !== $oldIndexElectricity || $exists->new_electricity_index !== $newIndexElectricity) {
    //                 $exists->old_electricity_index = $oldIndexElectricity;
    //                 $exists->new_electricity_index = $newIndexElectricity;
    //                 $exists->save();
    //             }
    //         } else {
    //             $electricity = new Electricity();
    //             $electricity->rental_room_id = $rentalRoomID;
    //             $electricity->date = now()->format('F Y');
    //             $electricity->old_electricity_index = $oldIndexElectricity;
    //             $electricity->new_electricity_index = $newIndexElectricity;
    //             $electricity->save();
    //         }
    //     }

    //     $oldIndexWater = $request->oldIndex_water;
    //     $newIndexWater = $request->newIndex_water;

    //     // Check if the current month's index exists
    //     if ($oldIndexWater != null && $newIndexWater != null && $oldIndexWater < $newIndexWater) {
    //         $exists = Water::where('rental_room_id', $rentalRoomID)
    //             ->where('date', $date)
    //             ->first();
    //         if ($exists) {
    //             if ($exists->old_water_index !== $oldIndexWater || $exists->new_water_index !== $newIndexWater) {
    //                 $exists->old_water_index = $oldIndexWater;
    //                 $exists->new_water_index = $newIndexWater;
    //                 $exists->save();
    //             }
    //         } else {
    //             $water = new Water();
    //             $water->rental_room_id = $rentalRoomID;
    //             $water->date = now()->format('F Y');
    //             $water->old_water_index = $oldIndexWater;
    //             $water->new_water_index = $newIndexWater;
    //             $water->save();
    //         }
    //     }

    //     return redirect()->back()->with('success', 'Successfully updated the indexes');
    // }
}
