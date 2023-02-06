<?php

namespace App\Http\Controllers\House\Room;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Room;

class RoomController extends Controller
{
    public function index($id)
    {
        $rooms = DB::table('tb_rooms')->where('area_id', $id)->paginate(10);
        $roomAvailable = DB::table('tb_rooms')->where('area_id', $id)->where('status', 0)->get();
        $countAvailable = count($roomAvailable);
        return view('house.room.index', compact(['rooms', 'id', 'countAvailable']))->with('title', 'Room Management');
        // dd($rooms);
    }

    public function addSingleRoom(Request $request, $id)
    {
        //add room to database
        $room = new Room();
        $room->room_name = $request->room_name;
        $room->price = $request->price;
        $room->room_description = $request->room_description;
        $room->area_id = $id;
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
            $room->area_id = $id;
            $room->save();
        }
        return redirect()->route('room.index', $id);
    }

    public function room()
    {
        $house = DB::table('tb_house')->where('user_id', auth()->user()->id)->get();

        return view('house.room.room', compact(['house']))->with('title', 'Room Management');
    }
}
