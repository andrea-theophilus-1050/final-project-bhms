<?php

namespace App\Http\Controllers\House\Room;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Termwind\Components\Dd;

class RoomController extends Controller
{
    public function index($id)
    {
        $rooms = DB::table('tb_rooms')->where('area_id', $id)->get();
        // return view('house.room.index', compact(['rooms', 'id']))->with('title', 'Room Management');
        dd($rooms);
    }
}
