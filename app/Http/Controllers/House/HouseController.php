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
        $houses = DB::table('tb_house')->where('user_id', auth()->user()->id)->get();
        return view('dashboard.house.index')->with('houses', $houses)->with('title', 'House Management');
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
