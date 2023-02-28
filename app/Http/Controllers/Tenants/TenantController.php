<?php

namespace App\Http\Controllers\Tenants;

use App\Exports\ExportTenantList;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Tenant;
use Maatwebsite\Excel\Facades\Excel;


class TenantController extends Controller
{
    public function index()
    {
        // $tenants = DB::table('tb_main_tenants')->where('user_id', auth()->user()->id)->paginate(5);
        $tenants = Tenant::where('user_id', auth()->user()->id)->paginate(30);
        return view('dashboard.tenants.index')->with('tenants', $tenants)->with('title', 'Tenant Management');
    }

    public function create()
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

        $id_card_front_name = null;
        $id_card_back_name = null;
        if ($request->hasFile('id_card_front') && $request->hasFile('id_card_back')) {
            $id_card_front = $request->file('id_card_front');
            $id_card_back = $request->file('id_card_back');

            $id_card_front_name = time() . '.' . $id_card_front->getClientOriginalExtension();
            $id_card_back_name = time() . '.' . $id_card_back->getClientOriginalExtension();

            $id_card_front->move(public_path('uploads/tenants/id_card_front'), $id_card_front_name);
            $id_card_back->move(public_path('uploads/tenants/id_card_back'), $id_card_back_name);
        }
        $tenant->citizen_card_front_image = $id_card_front_name;
        $tenant->citizen_card_back_image = $id_card_back_name;
        $tenant->save();
        return redirect()->route('tenant.index');
    }


    public function edit($id)
    {
        $tenant = Tenant::find($id);
        return view('dashboard.tenants.edit')->with('tenant', $tenant)->with('title', 'Edit Tenant');
    }

    public function update(Request $request, $id)
    {
        $tenant = Tenant::find($id);
        $tenant->fullname = $request->fullname;
        $tenant->gender = $request->gender;
        $tenant->dob = $request->dob;
        $tenant->id_card = $request->id_card;
        $tenant->phone_number = $request->phone;
        $tenant->email = $request->email;
        $tenant->hometown = $request->hometown;
        $tenant->save();
        return redirect()->route('tenant.index');
    }

    public function destroy($id)
    {
        $tenant = Tenant::find($id);
        $tenant->delete();
        return redirect()->route('tenant.index')->with('success', 'Tenant has been deleted successfully');
    }

    public function exportTenant()
    {
        return Excel::download(new ExportTenantList, 'tenantList.xlsx');
    }
}
