<?php

namespace App\Http\Controllers\Calculation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Services;
use App\Models\Utility;

class CalculationWaterElectricityController extends Controller
{
    public function utility_insert(Request $request)
    {
        $rentalRoomID = $request->rentalRoomID;
        $oldIndexElectricity = $request->oldIndex_electric;
        $newIndexElectricity = $request->newIndex_electric;
        $oldIndexWater = $request->oldIndex_water;
        $newIndexWater = $request->newIndex_water;

        $data = [];

        for ($i = 0; $i < count($rentalRoomID); $i++) {
            $data[] = [
                'rental_room_id' => $rentalRoomID[$i],
                'old_electricity_index' => $oldIndexElectricity[$i],
                'new_electricity_index' => $newIndexElectricity[$i],
                'old_water_index' => $oldIndexWater[$i],
                'new_water_index' => $newIndexWater[$i],
                // 'date' => $request->date[$i],
            ];
        }

        Utility::insert($data);
        return redirect()->back()->with('success', 'Insert data successfully');
    }
}
