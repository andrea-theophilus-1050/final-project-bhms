<?php

namespace App\Http\Controllers\House;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\House;
use Illuminate\Support\Facades\DB;

class HouseController extends Controller
{

    public function index()
    {
        // $houses = DB::table('tb_house')->where('user_id', auth()->user()->id)->get();
        $houses = House::where('user_id', auth()->user()->id)->get();
        $count = count($houses);

        if ($count > 1 || $count == 0) {
            session()->forget('hasOneHouse');
            return view('dashboard.house.index')->with('houses', $houses)->with('title', 'House Management');
        } else {
            if ($houses[0]->rooms->count() != 0) {
                session()->put('hasOneHouse', $count);
                return redirect()->route('room.index', $houses[0]->house_id);
            } else {
                return view('dashboard.house.index')->with('houses', $houses)->with('title', 'House Management');
            }
        }
    }

    public function store(Request $request)
    {
        // validate request
        $request->validate([
            'house_name' => 'required',
            'house_address' => 'required',
        ]);

        // add new house to database
        $house = new House();
        $house->house_name = $request->house_name;
        $house->house_address = $request->house_address;
        $house->house_description = $request->house_description;
        $house->user_id = auth()->user()->id;
        $house->save();
        return redirect()->route('house.index');
    }

    //Update house with house id
    public function update(Request $request, $id)
    {
        // validate request
        $request->validate([
            'house_name' => 'required',
            'house_address' => 'required',
        ]);

        $house = House::find($id);
        $house->house_name = $request->house_name;
        $house->house_address = $request->house_address;
        $house->house_description = $request->house_description;
        $house->save();
        return redirect()->route('house.index');
    }

    public function destroy(House $house)
    {
        $house->delete();
        return redirect()->route('house.index')->with('success', 'House has been deleted successfully');
    }
}
