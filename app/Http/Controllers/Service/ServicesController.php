<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Models\Services;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function index()
    {
        $services = Services::where('user_id', auth()->user()->id)->paginate(30);
        return view('dashboard.services.index')->with('title', 'Services Management')->with('services', $services);
    }

    public function store(Request $request)
    {
        $service = new Services();
        $service->service_name = $request->service_name;
        $service->price = $request->price;
        $service->description = $request->description;
        $service->user_id = auth()->user()->id;
        $service->save();
        return redirect()->route('services.index');
    }

    public function update(Request $request, $id)
    {
        $service = Services::find($id);
        $service->service_name = $request->service_name;
        $service->price = $request->price;
        $service->description = $request->description;
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
