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
        //validate
        $request->validate([
            'service_name' => 'required',
            'price' => 'required',
            'typeService' => 'required',
        ]);

        $typeService = $request->typeService;
        $existsService = "";

        if ($typeService == 1) {
            $existsService = Services::where('type_id', 1)->where('user_id', auth()->user()->id)->first();
        } elseif ($typeService == 2) {
            $existsService = Services::where('type_id', 2)->where('user_id', auth()->user()->id)->first();
        }

        if ($existsService) {
            return redirect()->back()->with('errors', 'You can only have one electricity or water service');
        }

        if ($request->price != 'NaN') {
            $service = new Services();
            $service->service_name = $request->service_name;
            $service->price = intval(str_replace(",", "", $request->price));
            $service->description = $request->description;
            $service->user_id = auth()->user()->id;
            $service->type_id = $request->typeService;
            $service->changed = 1;
            $service->save();
            return redirect()->route('services.index');
        } else {
            return redirect()->back()->with('errorPrice', 'Price is not valid');
        }
    }

    public function update(Request $request, $id)
    {
        //validate
        $request->validate([
            'price' => 'required',
        ]);

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
