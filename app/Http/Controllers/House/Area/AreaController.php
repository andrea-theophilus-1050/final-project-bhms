<?php

namespace App\Http\Controllers\House\Area;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Area;

class AreaController extends Controller
{
    public function index($id)
    {
        // $area = DB::table('tb_area')->where('house_id', $id)->get();
        $area = Area::where('house_id', $id)->get();
        return view('house.area.index')->with('area', $area)->with('title', 'Area Management');
    }
}
