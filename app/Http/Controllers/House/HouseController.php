<?php

namespace App\Http\Controllers\House;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\House;

class HouseController extends Controller
{
    public function addNewHouseAction(Request $request)
    {
        // add new house to database
        $house = new House();
        $house->house_name = $request->house_name;
        $house->house_address = $request->house_address;
        $house->house_description = $request->house_description;
        $house->user_id = auth()->user()->id;
        $house->save();
        return redirect()->route('house-area', app()->getLocale());
    }

    //Update house with house id
    public function updateHouseAction(Request $request)
    {
        $id = $request->house_id;
        $house = House::find($id);
        $house->house_name = $request->house_name;
        $house->house_address = $request->house_address;
        $house->house_description = $request->house_description;
        $house->save();
        return redirect()->route('house-area', app()->getLocale());

        
        // $house = House::find($id);
        // $house->house_name = $request->house_name;
        // $house->house_address = $request->house_address;
        // $house->house_description = $request->house_description;
        // $house->save();
        // return redirect()->route('house-area', app()->getLocale());
    }
}
