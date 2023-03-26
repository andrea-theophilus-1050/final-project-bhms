<?php

namespace App\Http\Controllers\Calculation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\House;
use Illuminate\Support\Facades\DB;
use App\Models\RoomBilling;


class RoomBillingController extends Controller
{
    // room billing page
    public function room_billing()
    {
        $houseList = House::where('user_id', auth()->user()->id)->get();

        $month = 'March 2023';

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

                    if (RoomBilling::where('rental_room_id', $result->rental_room_id)->where('date', $result->billDate)->count() == 0) {
                        $roomBilling = new RoomBilling();
                        $roomBilling->total_price = $result->total;
                        $roomBilling->rental_room_id = $result->rental_room_id;
                        $roomBilling->date = $result->billDate;
                        $roomBilling->save();
                    }

                    $data[] = $result;
                    break;
                }
            }
        }


        $roomBilling = RoomBilling::all();


        return view('dashboard.room-billing.room-bill-page', compact(['houseList', 'roomBilling']))->with('title', 'Room Billing');
    }

    public function calculateRoomBilling(Request $request)
    {
        $month = $request->month;
        $house = $request->house;



        return view('dashboard.room-billing.room-billing', compact(['data']))->with('title', 'Room Billing');
    }

    public function test()
    {
        $waterBills = DB::table('tb_water_bill')
            ->join('tb_rental_room', 'tb_water_bill.rental_room_id', '=', 'tb_rental_room.rental_room_id')
            ->join('tb_main_tenants', 'tb_rental_room.tenant_id', '=', 'tb_main_tenants.tenant_id')
            ->join('tb_rooms', 'tb_rental_room.room_id', '=', 'tb_rooms.room_id')
            ->join('tb_services_used', 'tb_rental_room.rental_room_id', '=', 'tb_services_used.rental_room_id')
            ->join('tb_house', 'tb_rooms.house_id', '=', 'tb_house.house_id')
            ->where('tb_water_bill.date', 'March 2023')
            ->where('tb_house.user_id', auth()->user()->id)
            ->where('tb_services_used.service_id', 1)
            ->select('tb_rental_room.rental_room_id', 'tb_water_bill.new_water_index', 'tb_water_bill.old_water_index', 'tb_water_bill.date', 'tb_services_used.price_if_changed', 'tb_rooms.price', 'tb_rooms.room_name', 'tb_rooms.room_id', 'tb_house.house_name', 'tb_house.house_address', 'tb_main_tenants.fullname', 'tb_main_tenants.phone_number', 'tb_main_tenants.email')
            ->get();

        // foreach ($waterBills as $waterBill) {
        //     $waterBill->consume = $waterBill->new_water_index - $waterBill->old_water_index;
        //     $waterBill->totalByConsume = $waterBill->consume * $waterBill->price_if_changed;
        // }

        $electricityBill = DB::table('tb_electricity_bill')
            ->join('tb_rental_room', 'tb_electricity_bill.rental_room_id', '=', 'tb_rental_room.rental_room_id')
            ->join('tb_main_tenants', 'tb_rental_room.tenant_id', '=', 'tb_main_tenants.tenant_id')
            ->join('tb_rooms', 'tb_rental_room.room_id', '=', 'tb_rooms.room_id')
            ->join('tb_services_used', 'tb_rental_room.rental_room_id', '=', 'tb_services_used.rental_room_id')
            ->join('tb_house', 'tb_rooms.house_id', '=', 'tb_house.house_id')
            ->where('tb_house.user_id', auth()->user()->id)
            ->where('tb_services_used.service_id', 2)
            ->where('tb_electricity_bill.date', 'March 2023')
            ->select('tb_rental_room.rental_room_id', 'tb_electricity_bill.new_electricity_index', 'tb_electricity_bill.old_electricity_index', 'tb_electricity_bill.date', 'tb_services_used.price_if_changed', 'tb_rooms.price', 'tb_rooms.room_name', 'tb_rooms.room_id', 'tb_house.house_name', 'tb_house.house_address', 'tb_main_tenants.fullname', 'tb_main_tenants.phone_number', 'tb_main_tenants.email')
            ->get();

        $costsIncurred = DB::table('tb_costs_incurred')
            ->join('tb_rental_room', 'tb_costs_incurred.rental_room_id', '=', 'tb_rental_room.rental_room_id')
            ->join('tb_rooms', 'tb_rental_room.room_id', '=', 'tb_rooms.room_id')
            ->join('tb_house', 'tb_rooms.house_id', '=', 'tb_house.house_id')
            ->where('tb_house.user_id', auth()->user()->id)
            ->where('tb_costs_incurred.date', 'March 2023')
            ->select('tb_rental_room.rental_room_id', 'tb_costs_incurred.date', 'tb_costs_incurred.price', 'tb_costs_incurred.reason', 'tb_rooms.room_name', 'tb_rooms.room_id', 'tb_house.house_name', 'tb_house.house_address')
            ->get();

        // $json = json_encode($costsIncurred, JSON_PRETTY_PRINT);

        // return response($json, 200)
        //     ->header('Content-Type', 'application/json');
        $otherServicesUsed = DB::table('tb_services_used')
            ->join('tb_services', 'tb_services_used.service_id', '=', 'tb_services.service_id')
            ->join('tb_type_service', 'tb_services.type_id', '=', 'tb_type_service.type_id')
            ->join('tb_rental_room', 'tb_services_used.rental_room_id', '=', 'tb_rental_room.rental_room_id')
            ->join('tb_main_tenants', 'tb_rental_room.tenant_id', '=', 'tb_main_tenants.tenant_id')
            ->where('tb_type_service.type_id', '!=', 1)
            ->where('tb_type_service.type_id', '!=', 2)
            ->select('tb_services_used.service_id', 'tb_services_used.price_if_changed', 'tb_services.service_name', 'tb_services.service_id', 'tb_type_service.type_name', 'tb_type_service.type_id', 'tb_rental_room.rental_room_id')
            ->get();


        // $json = json_encode($otherServicesUsed, JSON_PRETTY_PRINT);
        // return response($json, 200)
        //     ->header('Content-Type', 'application/json');


        // $json = json_encode($otherServicesUsed, JSON_PRETTY_PRINT);
        // return response($json, 200)
        //     ->header('Content-Type', 'application/json');

        $data = [];

        // $json = json_encode($costsIncurred, JSON_PRETTY_PRINT);
        // return response($json, 200)
        //     ->header('Content-Type', 'application/json');

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

                    $result->total = $result->waterTotalPrice + $result->electricityTotalPrice + $result->room_price + collect($result->costsIncurred)->sum('price') + collect($result->otherServicesUsed)->sum('price_if_changed');

                    $data[] = $result;
                    break;
                }
            }
        }

        // foreach ($costsIncurred as $cost) {
        //     foreach ($data as $item) {
        //         if ($cost->rental_room_id == $item->rental_room_id) {
        //             $item->costsIncurred[] = $cost;
        //             break;
        //         }
        //     }
        // }

        $json = json_encode($data, JSON_PRETTY_PRINT);
        return response($json, 200)
            ->header('Content-Type', 'application/json');



        // $json = json_encode($waterBills, JSON_PRETTY_PRINT);
        // return response($json, 200)
        //     ->header('Content-Type', 'application/json');


        // foreach ($electricityBill as $electricity) {
        //     $electricity->consume = $electricity->new_electricity_index - $electricity->old_electricity_index;
        //     $electricity->totalByConsume = $electricity->consume * $electricity->price_if_changed;
        // }

        // $bills = $waterBills->merge($electricityBill);



        // $json = json_encode($bills, JSON_PRETTY_PRINT);
        // return response($json, 200)
        //     ->header('Content-Type', 'application/json');




        // $jsonData = json_encode($data, JSON_PRETTY_PRINT);
        // return response($jsonData, 200)
        //     ->header('Content-Type', 'application/json');


        // $json = json_encode($waterBills, JSON_PRETTY_PRINT);

        // //return json format
        // return response($json, 200)
        //     ->header('Content-Type', 'application/json');
    }
}
