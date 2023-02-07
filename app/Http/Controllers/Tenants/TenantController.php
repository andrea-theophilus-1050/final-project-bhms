<?php

namespace App\Http\Controllers\Tenants;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Tenant;

class TenantController extends Controller
{
    public function index()
    {
        $tenants = DB::table('tb_main_tenants')->where('user_id', auth()->user()->id)->paginate(5);
        return view('dashboard.tenants.index')->with('tenants', $tenants)->with('title', 'Tenant Management');
    }

    public function add()
    {
        return view('dashboard.tenants.add')->with('title', 'Add New Tenant');
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'tenant_name' => 'required',
        //     'tenant_phone' => 'required',
        //     'tenant_email' => 'required',
        //     'tenant_address' => 'required',
        // ]);

        $tenant = new Tenant();
        $tenant->fullname = $request->fullname;
        $tenant->gender = $request->gender;
        $tenant->dob = $request->dob;
        $tenant->id_card = $request->id_card;
        $tenant->phone_number = $request->phone;
        $tenant->email = $request->email;
        $tenant->hometown = $request->hometown;
        $tenant->user_id = auth()->user()->id;
        $tenant->save();
        return redirect()->route('tenant.index');
    }

    public function test()
    {
        return back()->with('success', 'Add new tenant successfully!');
    }
}
