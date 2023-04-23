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
        $rentalID = $request->rentalID;

        $rentalRoom = RentalRoom::find($rentalID);
        $rentalRoom->status = 1;
        $rentalRoom->end_date = Carbon::now();
        $rentalRoom->save();

        return redirect()->back()->with('success', 'Room returned successfully');
    }

    public function cancelReturnRoom(Request $request)
    {
        $rentalID = $request->rentalID;

        $rentalRoom = RentalRoom::find($rentalID);
        $rentalRoom->status = 0;
        $rentalRoom->end_date = null;
        $rentalRoom->save();

        return redirect()->back()->with('success', 'Cancel return room successfully');
    }

    public function confirmReturnRoom(Request $request)
    {
        $rentalID = $request->rentalRoomID;
        $roomID = $request->roomID;
        $tenantID = $request->tenantID;

        $btnSubmit = $request->input('status');

        switch ($btnSubmit) {
            case 'return':
                $rentalRoom = RentalRoom::find($rentalID);
                $rentalRoom->delete();

                $room = Room::find($roomID);
                $room->status = 0;
                $room->save();

                $tenant = Tenant::find($tenantID);
                $tenant->status = 2;
                $tenant->save();

                return redirect()->back()->with('success', 'Room returned successfully');
                break;

            case 'keep_staying':
                $rentalRoom = RentalRoom::find($rentalID);
                $rentalRoom->status = 0;
                $rentalRoom->end_date = null;
                $rentalRoom->save();

                return redirect()->back()->with('success', 'Cancel return room successfully');
                break;
        }
    }
}
