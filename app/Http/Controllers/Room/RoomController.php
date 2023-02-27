<?php

namespace App\Http\Controllers\Room;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Room;
use App\Models\Tenant;
use App\Models\RentalRoom;
use App\Models\Services;

class RoomController extends Controller
{
    public function index($id)
    {
        $rooms = Room::where('house_id', $id)->orderBy('status', 'asc')->paginate(20);
        $tenants = Tenant::where('user_id', auth()->user()->id)->where('status', 0)->get();

        $countTotal = Room::where('house_id', $id)->count();
        $countRentedRoom = Room::where('house_id', $id)->where('status', 1)->count();
        $countAvailableRoom = Room::where('house_id', $id)->where('status', 0)->count();

        return view('dashboard.room.index', compact(
            [
                'rooms',
                'tenants',
                'id',
                'countTotal',
                'countRentedRoom',
                'countAvailableRoom'
            ]
        ))->with('title', 'Room Management');
    }

    public function addSingleRoom(Request $request, $id)
    {
        //add room to database
        $room = new Room();
        $room->room_name = $request->room_name;
        $room->price = intval(str_replace(",", "", $request->price));
        $room->room_description = $request->room_description;
        $room->house_id = $id;
        $room->save();
        return redirect()->route('room.index', $id);
    }

    public function addMultipleRooms(Request $request, $id)
    {
        for ($i = 0; $i < $request->quantity; $i++) {
            $room = new Room();
            $room->room_name = $request->room_name . ' ' . ($i + 1);
            $room->price = intval(str_replace(",", "", $request->price));
            $room->room_description = $request->room_description;
            $room->house_id = $id;
            $room->save();
        }
        return redirect()->route('room.index', $id);
    }

    public function update(Request $request, $id)
    {
        $room = Room::find($id);
        $room->room_name = $request->room_name_edit;
        $room->price = intval(str_replace(",", "", $request->price_edit));
        $room->room_description = $request->room_description_edit;
        $room->save();
        return redirect()->route('room.index', $room->house_id)->with('success', 'Room has been updated successfully');
    }

    public function delete(Request $request, $house_id)
    {
        $id = $request->id;
        $room = Room::find($id);
        $room->delete();
        return redirect()->route('room.index', $house_id)->with('success', 'Room has been deleted successfully');
    }

    public function assignTenant($id)
    {
        $room = Room::find($id);
        $tenants = Tenant::where('user_id', auth()->user()->id)->where('status', 0)->get();
        $services = Services::where('user_id', auth()->user()->id)->get();
        // dd($room);
        return view('dashboard.room.assign-tenant', compact(['room', 'tenants', 'services']))->with('title', 'Assign Tenant');
    }

    public function assignTenant_action(Request $request, $id)
    {
        if ($request->tenant_id == null) {
            
            DB::beginTransaction();

            try {
                // add new tenant
                $tenant = new Tenant();
                $tenant->fullname = $request->fullname;
                $tenant->gender = $request->gender;
                $tenant->dob = $request->dob;
                $tenant->id_card = $request->id_card;
                $tenant->phone_number = $request->phone;
                $tenant->email = $request->email;
                $tenant->hometown = $request->hometown;
                $tenant->status = 1;
                $tenant->user_id = auth()->user()->id;
                $tenant->save();

                // update status of room to 1, means it is rented
                $room = Room::find($id);
                $room->status = 1;
                $room->save();

                // add data to rental room
                $rental = new RentalRoom();
                $rental->room_id = $id;
                $rental->tenant_id = $tenant->tenant_id;
                $rental->start_date = $request->start_date;
                // $rental->end_date = $request->end_date;
                $rental->save();

            } catch (\Exception $e) {
                DB::rollBack();
                throw $e;
            }

            DB::commit();

            return redirect()->route('room.index', $room->house_id)->with('success', 'Room has been assigned successfully');
        } else {
            // update status of room to 1, means it is rented
            $room = Room::find($id);
            $room->status = 1;
            $room->save();

            $tenant = Tenant::find($request->tenant_id);
            $tenant->status = 1;
            $tenant->save();

            // add data to rental room
            $rental = new RentalRoom();
            $rental->room_id = $id;
            $rental->tenant_id = $request->tenant_id;
            $rental->start_date = $request->start_date;
            // $rental->end_date = $request->end_date;
            $rental->save();
            return redirect()->route('room.index', $room->house_id)->with('success', 'Room has been assigned successfully');
        }

        // dd($request->all());
    }

    public function assignMembers(Request $request)
    {
        dd($request->all());
    }

    // public function getMembers(Request $request)
    // {
    //     dd($request->all());
    // }

    // public function room()
    // {
    //     $house = DB::table('tb_rooms')->where('area_id', 2)->get();

    //     return view('dashboard.room.room', compact(['house']))->with('title', 'Room Management');
    // }
}
