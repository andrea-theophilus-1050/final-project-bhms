<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    // home dashboard
    public function index()
    {
        return view('dashboard.index')->with('title', 'Dashboard');
    }

    // feedback page
    public function feedback()
    {
        $feedbacks = Feedback::orderBy('created_at', 'desc')->orderBy('status', 'desc')->paginate(10);
        return view('dashboard.feedback.feedback', compact(['feedbacks']))->with('title', 'Feedback');
    }

    public function pdf($month)
    {
        $waterBills = DB::table('tb_water_bill')
            ->join('tb_rental_room', 'tb_water_bill.rental_room_id', '=', 'tb_rental_room.rental_room_id')
            ->join('tb_main_tenants', 'tb_rental_room.tenant_id', '=', 'tb_main_tenants.tenant_id')
            ->join('tb_rooms', 'tb_rental_room.room_id', '=', 'tb_rooms.room_id')
            ->join('tb_services_used', 'tb_rental_room.rental_room_id', '=', 'tb_services_used.rental_room_id')
            ->join('tb_house', 'tb_rooms.house_id', '=', 'tb_house.house_id')
            ->where('tb_house.user_id', auth()->user()->id)
            ->where('tb_services_used.service_id', 1)
            ->where('tb_water_bill.date', $month)
            ->select(
                'tb_rental_room.rental_room_id',
                'tb_water_bill.new_water_index',
                'tb_water_bill.old_water_index',
                'tb_water_bill.date',
                'tb_services_used.price_if_changed',
                'tb_rooms.price',
                'tb_rooms.room_name',
                'tb_rooms.room_id',
                'tb_house.house_name',
                'tb_house.house_address',
                'tb_main_tenants.fullname',
                'tb_main_tenants.phone_number',
                'tb_main_tenants.email'
            )->get();

        $electricityBill = DB::table('tb_electricity_bill')
            ->join('tb_rental_room', 'tb_electricity_bill.rental_room_id', '=', 'tb_rental_room.rental_room_id')
            ->join('tb_main_tenants', 'tb_rental_room.tenant_id', '=', 'tb_main_tenants.tenant_id')
            ->join('tb_rooms', 'tb_rental_room.room_id', '=', 'tb_rooms.room_id')
            ->join('tb_services_used', 'tb_rental_room.rental_room_id', '=', 'tb_services_used.rental_room_id')
            ->join('tb_house', 'tb_rooms.house_id', '=', 'tb_house.house_id')
            ->where('tb_house.user_id', auth()->user()->id)
            ->where('tb_services_used.service_id', 2)
            ->where('tb_electricity_bill.date', $month)
            ->select(
                'tb_rental_room.rental_room_id',
                'tb_electricity_bill.new_electricity_index',
                'tb_electricity_bill.old_electricity_index',
                'tb_electricity_bill.date',
                'tb_services_used.price_if_changed',
                'tb_rooms.price',
                'tb_rooms.room_name',
                'tb_rooms.room_id',
                'tb_house.house_name',
                'tb_house.house_address',
                'tb_main_tenants.fullname',
                'tb_main_tenants.phone_number',
                'tb_main_tenants.email'
            )->get();

        $costsIncurred = DB::table('tb_costs_incurred')
            ->join('tb_rental_room', 'tb_costs_incurred.rental_room_id', '=', 'tb_rental_room.rental_room_id')
            ->join('tb_rooms', 'tb_rental_room.room_id', '=', 'tb_rooms.room_id')
            ->join('tb_house', 'tb_rooms.house_id', '=', 'tb_house.house_id')
            ->where('tb_house.user_id', auth()->user()->id)
            ->where('tb_costs_incurred.date', $month)
            ->select(
                'tb_rental_room.rental_room_id',
                'tb_costs_incurred.date',
                'tb_costs_incurred.price',
                'tb_costs_incurred.reason',
                'tb_rooms.room_name',
                'tb_rooms.room_id',
                'tb_house.house_name',
                'tb_house.house_address'
            )
            ->get();

        $otherServicesUsed = DB::table('tb_services_used')
            ->join('tb_services', 'tb_services_used.service_id', '=', 'tb_services.service_id')
            ->join('tb_type_service', 'tb_services.type_id', '=', 'tb_type_service.type_id')
            ->join('tb_rental_room', 'tb_services_used.rental_room_id', '=', 'tb_rental_room.rental_room_id')
            ->join('tb_main_tenants', 'tb_rental_room.tenant_id', '=', 'tb_main_tenants.tenant_id')
            ->where('tb_type_service.type_id', '!=', 1)
            ->where('tb_type_service.type_id', '!=', 2)
            ->select(
                'tb_services_used.service_id',
                'tb_services_used.price_if_changed',
                'tb_services.service_name',
                'tb_services.service_id',
                'tb_type_service.type_name',
                'tb_type_service.type_id',
                'tb_rental_room.rental_room_id'
            )->get();

        $data = [];

        foreach ($waterBills as $waterBill) {
            foreach ($electricityBill as $electricity) {
                if ($waterBill->room_id == $electricity->room_id) {

                    $result = new \stdClass();
                    $result->rental_room_id = $waterBill->rental_room_id;
                    $result->house_name = $waterBill->house_name;
                    $result->house_address = $waterBill->house_address;
                    $result->room_name = $waterBill->room_name;
                    $result->room_price = $waterBill->price;
                    $result->tenant_name = $waterBill->fullname;
                    $result->tenant_phone = $waterBill->phone_number;
                    $result->tenant_email = $waterBill->email;
                    $result->waterServicePrice = $waterBill->price_if_changed;
                    $result->electricityServicePrice = $electricity->price_if_changed;

                    $result->billDate = $waterBill->date;

                    $result->old_water_index = $waterBill->old_water_index;
                    $result->new_water_index = $waterBill->new_water_index;
                    $result->old_electricity_index = $electricity->old_electricity_index;
                    $result->new_electricity_index = $electricity->new_electricity_index;

                    $result->waterConsume = $waterBill->new_water_index - $waterBill->old_water_index;
                    $result->electricityConsume = $electricity->new_electricity_index - $electricity->old_electricity_index;

                    $result->waterTotalPrice = $result->waterConsume * $result->waterServicePrice;
                    $result->electricityTotalPrice = $result->electricityConsume * $result->electricityServicePrice;

                    if (collect($costsIncurred)->where('rental_room_id', $waterBill->rental_room_id)->count() > 0) {
                        $result->costsIncurred = collect($costsIncurred)->where('rental_room_id', $waterBill->rental_room_id)->toArray();
                    } else {
                        $result->costsIncurred = [];
                    }

                    if (collect($otherServicesUsed)->where('rental_room_id', $waterBill->rental_room_id)->count() > 0) {
                        $result->otherServicesUsed = collect($otherServicesUsed)->where('rental_room_id', $waterBill->rental_room_id)->toArray();
                    } else {
                        $result->otherServicesUsed = [];
                    }

                    $result->total = $result->waterTotalPrice + $result->electricityTotalPrice +
                        $result->room_price + collect($result->costsIncurred)->sum('price') +
                        collect($result->otherServicesUsed)->sum('price_if_changed');

                    $data[] = $result;
                    break;
                }
            }
        }

        $pdf = \PDF::loadView('pdf.test', compact(['data']));
        return $pdf->download('test.pdf');
    }
}
