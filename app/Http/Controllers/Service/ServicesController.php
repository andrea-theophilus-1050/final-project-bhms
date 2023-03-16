<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Models\Services;
use App\Models\TypeService;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function index()
    {
        $services = Services::where('user_id', auth()->user()->id)->paginate(30);
        $type = TypeService::all();
        return view('dashboard.services.index')->with('title', 'Services Management')->with('services', $services)->with('type', $type);
    }

    public function store(Request $request)
    {
        $typeService = $request->typeService;
        $existsService = "";

        if ($typeService == 1) {
            $existsService = Services::where('type_id', 1)->where('user_id', auth()->user()->id)->first();
        } elseif ($typeService == 2) {
            $existsService = Services::where('type_id', 2)->where('user_id', auth()->user()->id)->first();
        }

        if ($existsService) {
            return redirect()->back()->with('error', 'You can only have one electricity or water service');
        }

        $service = new Services();
        $service->service_name = $request->service_name;
        $service->price = intval(str_replace(",", "", $request->price));
        $service->description = $request->description;
        $service->user_id = auth()->user()->id;
        $service->type_id = $request->typeService;
        $service->changed = 1;
        $service->save();
        return redirect()->route('services.index');
    }

    public function update(Request $request, $id)
    {
        $service = Services::find($id);
        $service->price = intval(str_replace(",", "", $request->price));
        $service->description = $request->description;
        $service->changed = 1;
        $service->save();
        return redirect()->route('services.index');
    }

    public function destroy($id)
    {
        $service = Services::find($id);
        $service->delete();
        return redirect()->route('services.index');
    }
}
