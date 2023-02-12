<?php

namespace App\Http\Controllers\Room;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Room;

class RoomController extends Controller
{
    public function index($id)
    {
        $rooms = Room::where('house_id', $id)->paginate(20);
        // $roomAvailable = DB::table('tb_rooms')->where('area_id', $id)->where('status', 0)->get();
        // $countAvailable = count($roomAvailable);
        return view('dashboard.room.index', compact(['rooms', 'id']))->with('title', 'Room Management');
        // dd($rooms);
    }

    public function addSingleRoom(Request $request, $id)
    {
        //add room to database
        $room = new Room();
        $room->room_name = $request->room_name;
        $room->price = $request->price;
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
            $room->price = $request->price;
            $room->room_description = $request->room_description;
            $room->house_id = $id;
            $room->save();
        }
        return redirect()->route('room.index', $id);
    }

    public function delete(Request $request, $house_id)
    {
        $id = $request->id;
        $room = Room::find($id);
        $room->delete();
        return redirect()->route('room.index', $house_id)->with('success', 'Room has been deleted successfully');
    }

    // public function room()
    // {
    //     $house = DB::table('tb_rooms')->where('area_id', 2)->get();

    //     return view('dashboard.room.room', compact(['house']))->with('title', 'Room Management');
    // }
}
