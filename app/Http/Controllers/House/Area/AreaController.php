<?php

namespace App\Http\Controllers\House\Area;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Area;
use Termwind\Components\Dd;

class AreaController extends Controller
{
    public function index($id)
    {
        // $area = DB::table('tb_area')->where('house_id', $id)->get();
        $area = Area::where('house_id', $id)->get();
        return view('house.area.index', compact(['area', 'id']))->with('title', 'Area Management');
    }

    public function add_action(Request $request, $id)
    {
        // $request->validate([
        //     'area_name' => 'required',
        //     'area_price' => 'required',
        //     'area_description' => 'required',
        // ]);

        $area = new Area();
        $area->area_name = $request->area_name;
        $area->area_description = $request->area_description;
        $area->house_id = $id;
        $area->save();

        return redirect()->route('area.index', $id)->with('success', 'Add new area successfully!');
    }

    public function update_action(Request $request, $id)
    {
        $area = Area::find($id);
        $area->area_name = $request->area_name;
        $area->area_description = $request->area_description;
        $area->save();

        return redirect()->route('area.index', $area->house_id)->with('success', 'Update area successfully!');
    }

    public function delete_action($id)
    {
        $area = Area::find($id);
        $area->delete();

        return redirect()->route('area.index', $area->house_id)->with('success', 'Delete area successfully!');
    }
}
