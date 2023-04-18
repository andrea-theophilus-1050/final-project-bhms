<?php

namespace App\Http\Controllers\Tenants;

use App\Exports\ExportTenantList;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Tenant;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Twilio\Rest\Client;


class TenantController extends Controller
{
    public function index()
    {
        // $tenants = DB::table('tb_main_tenants')->where('user_id', auth()->user()->id)->paginate(5);
        $tenants = Tenant::where('user_id', auth()->user()->id)->orderByRaw("FIELD(status, 1, 0, 2)")->paginate(30);
        return view('dashboard.tenants.index')->with('tenants', $tenants)->with('title', 'Tenant Management');
    }

    public function create()
    {
        return view('dashboard.tenants.add')->with('title', 'Add New Tenant');
    }

    public function store(Request $request)
    {
        $request->validate([
            'fullname' => 'required',
            'dob' => 'required',
            'id_card' => 'required|unique:tb_main_tenants',
            'email' => 'email|unique:tb_main_tenants',
            'phone_number' => 'required|unique:tb_main_tenants',
            'hometown' => 'required',
        ]);

        $tenant = new Tenant();
        $tenant->fullname = $request->fullname;
        $tenant->gender = $request->gender;
        $tenant->dob = $request->dob;
        $tenant->id_card = $request->id_card;
        $tenant->phone_number = $request->phone_number;
        $tenant->email = $request->email;
        $tenant->hometown = $request->hometown;
        $tenant->user_id = auth()->user()->id;

        $id_card_front_name = null;
        $id_card_back_name = null;
        if ($request->hasFile('id_card_front') && $request->hasFile('id_card_back')) {
            $id_card_front = $request->file('id_card_front');
            $id_card_back = $request->file('id_card_back');

            $id_card_front_name = 'front - ' . $request->fullname . time() . '.' . $id_card_front->getClientOriginalExtension();
            $id_card_back_name = 'back - ' . $request->fullname . time() . '.' . $id_card_back->getClientOriginalExtension();

            $id_card_front->move(public_path('uploads/tenants/id_card_front'), $id_card_front_name);
            $id_card_back->move(public_path('uploads/tenants/id_card_back'), $id_card_back_name);
        }
        $tenant->citizen_card_front_image = $id_card_front_name;
        $tenant->citizen_card_back_image = $id_card_back_name;
        $tenant->save();

        return redirect()->route('tenant.index')->with('success', 'Tenant has been added successfully');
    }


    public function edit($id)
    {
        $tenant = Tenant::find($id);
        return view('dashboard.tenants.edit')->with('tenant', $tenant)->with('title', 'Edit Tenant');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fullname' => 'required',
            'dob' => 'required',
            'id_card' => 'required',
            'phone' => 'required',
            'hometown' => 'required',
        ]);

        // check id card exists
        $check_id_card = DB::table('tb_main_tenants')->where('id_card', $request->id_card)->where('tenant_id', '!=', $id)->first();
        $check_phone_number = DB::table('tb_main_tenants')->where('phone_number', $request->phone)->where('tenant_id', '!=', $id)->first();
        $check_email = DB::table('tb_main_tenants')->where('email', $request->email)->where('tenant_id', '!=', $id)->first();

        if ($check_id_card) {
            return redirect()->back()->with('error', 'ID card already exists')->withInput($request->all());
        } elseif ($check_phone_number) {
            return redirect()->back()->with('error', 'Phone number already exists')->withInput($request->all());
        } elseif ($check_email) {
            return redirect()->back()->with('error', 'Email already exists')->withInput($request->all());
        } else {
            $tenant = Tenant::find($id);
            $tenant->fullname = $request->fullname;
            $tenant->gender = $request->gender;
            $tenant->dob = $request->dob;
            $tenant->id_card = $request->id_card;
            $tenant->phone_number = $request->phone;
            $tenant->email = $request->email;
            $tenant->hometown = $request->hometown;
            $tenant->save();
            return redirect()->route('tenant.index')->with('success', 'Tenant has been updated successfully');
        }
    }

    public function destroy($id)
    {
        $tenant = Tenant::find($id);
        $tenant->delete();
        return redirect()->route('tenant.index')->with('success', 'Tenant has been deleted successfully');
    }

    public function sendAccountInfo($id)
    {
        $tenant = Tenant::find($id);
        Mail::to($tenant->email)->send(new \App\Mail\NotifyAccountInfo($tenant));

        if ($tenant->phone_number == '+84398371050') {
            $sid = env('TWILIO_SID');
            $token = env('TWILIO_TOKEN');
            $numberFrom = env('TWILIO_FROM');

            $client = new Client($sid, $token);

            $client->messages->create(
                $tenant->phone_number,
                [
                    'from' => $numberFrom,
                    'body' => chr(10) . 'Hello: ' . $tenant->fullname . chr(10) . chr(10) . // chr(10) is a new line
                        'This is your account to login to the system: ' . chr(10) . chr(10) .
                        'Email: ' . $tenant->email . chr(10) .
                        'Password: 12345678' . chr(10) . chr(10) .
                        'or' . chr(10) . chr(10) .
                        'Phone number: ' . $tenant->phone_number . chr(10) .
                        'Password: 12345678' . chr(10) . chr(10) .
                        'Please access to the system via: ' . url('/') . '/tenant/login'
                ]
            );
        }

        return redirect()->back()->with('success', 'Account info has been sent successfully');
    }

    public function exportTenant()
    {
        return Excel::download(new ExportTenantList, 'tenantList.xlsx');
    }
}
