<?php

namespace App\Http\Controllers\Calculation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\House;
use Illuminate\Support\Facades\DB;
use App\Models\RoomBilling;


class RoomBillingController extends Controller
{
    // NOTE: room billing page
    public function room_billing($month, $house)
    {
        $waterBills = $this->getWaterBills($month, $house);

        $electricityBill = $this->getElectricityBills($month, $house);

        $costsIncurred = $this->getCostsIncurred($month, $house);

        $otherServicesUsed = $this->getOtherServicesUsed();

        $data = $this->getData($waterBills, $electricityBill, $costsIncurred, $otherServicesUsed);

        // NOTE: Get the house list for the dropdown list
        $houseList = House::where('user_id', auth()->user()->id)->get();

        // NOTE: Get the room billing list to display status of the room billing
        $roomBilling = RoomBilling::all();

        return view('dashboard.room-billing.room-billing', compact(['houseList', 'roomBilling', 'data', 'month', 'house']))->with('title', 'Room Billing');
    }

    public function test()
    {
        $month = "March 2023";
        $house = 'all-house';
        $waterBills = $this->getWaterBills($month, $house);

        $electricityBill = $this->getElectricityBills($month, $house);

        $costsIncurred = $this->getCostsIncurred($month, $house);

        $otherServicesUsed = $this->getOtherServicesUsed();

        $data = $this->getData($waterBills, $electricityBill, $costsIncurred, $otherServicesUsed);

        // return data with Pretty JSON
        return response()->json($data, 200, [], JSON_PRETTY_PRINT);
    }

    public function calculateRoomBilling(Request $request)
    {
        $month = $request->month;
        $house = $request->house;

        return redirect()->route('room-billing', [$month, $house]);
    }

    public function updateStatusBill(Request $request, $id)
    {
        $roomBilling = RoomBilling::find($id);
        $roomBilling->paidAmount = intval(str_replace(",", "", $request->paidAmount));
        $roomBilling->debt = intval(str_replace(",", "", $request->debt));
        if ($request->debt == 0) {
            $roomBilling->status = 1;
        } else {
            $roomBilling->status = 2;
        }
        $roomBilling->save();
        return redirect()->back();
    }



    public function getWaterBills($month, $house)
    {
        if ($house != 'all-house') {
            $waterBills = DB::table('tb_water_bill')
                ->join('tb_rental_room', 'tb_water_bill.rental_room_id', '=', 'tb_rental_room.rental_room_id')
                ->join('tb_main_tenants', 'tb_rental_room.tenant_id', '=', 'tb_main_tenants.tenant_id')
                ->join('tb_rooms', 'tb_rental_room.room_id', '=', 'tb_rooms.room_id')
                ->join('tb_services_used', 'tb_rental_room.rental_room_id', '=', 'tb_services_used.rental_room_id')
                ->join('tb_services', 'tb_services_used.service_id', '=', 'tb_services.service_id')
                ->join('tb_type_service', 'tb_services.type_id', '=', 'tb_type_service.type_id')
                ->join('tb_house', 'tb_rooms.house_id', '=', 'tb_house.house_id')
                ->where('tb_house.user_id', auth()->user()->id)
                ->where('tb_house.house_id', $house)
                ->where('tb_services.type_id', 2)
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
        } else {
            $waterBills = DB::table('tb_water_bill')
                ->join('tb_rental_room', 'tb_water_bill.rental_room_id', '=', 'tb_rental_room.rental_room_id')
                ->join('tb_main_tenants', 'tb_rental_room.tenant_id', '=', 'tb_main_tenants.tenant_id')
                ->join('tb_rooms', 'tb_rental_room.room_id', '=', 'tb_rooms.room_id')
                ->join('tb_services_used', 'tb_rental_room.rental_room_id', '=', 'tb_services_used.rental_room_id')
                ->join('tb_services', 'tb_services_used.service_id', '=', 'tb_services.service_id')
                ->join('tb_type_service', 'tb_services.type_id', '=', 'tb_type_service.type_id')
                ->join('tb_house', 'tb_rooms.house_id', '=', 'tb_house.house_id')
                ->where('tb_house.user_id', auth()->user()->id)
                ->where('tb_services.type_id', 2)
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
        }
        return $waterBills;
    }

    public function getElectricityBills($month, $house)
    {
        if ($house != 'all-house') {
            $electricityBill = DB::table('tb_electricity_bill')
                ->join('tb_rental_room', 'tb_electricity_bill.rental_room_id', '=', 'tb_rental_room.rental_room_id')
                ->join('tb_main_tenants', 'tb_rental_room.tenant_id', '=', 'tb_main_tenants.tenant_id')
                ->join('tb_rooms', 'tb_rental_room.room_id', '=', 'tb_rooms.room_id')
                ->join('tb_services_used', 'tb_rental_room.rental_room_id', '=', 'tb_services_used.rental_room_id')
                ->join('tb_services', 'tb_services_used.service_id', '=', 'tb_services.service_id')
                ->join('tb_type_service', 'tb_services.type_id', '=', 'tb_type_service.type_id')
                ->join('tb_house', 'tb_rooms.house_id', '=', 'tb_house.house_id')
                ->where('tb_house.user_id', auth()->user()->id)
                ->where('tb_house.house_id', $house)
                ->where('tb_services.type_id', 1)
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
        } else {
            $electricityBill = DB::table('tb_electricity_bill')
                ->join('tb_rental_room', 'tb_electricity_bill.rental_room_id', '=', 'tb_rental_room.rental_room_id')
                ->join('tb_main_tenants', 'tb_rental_room.tenant_id', '=', 'tb_main_tenants.tenant_id')
                ->join('tb_rooms', 'tb_rental_room.room_id', '=', 'tb_rooms.room_id')
                ->join('tb_services_used', 'tb_rental_room.rental_room_id', '=', 'tb_services_used.rental_room_id')
                ->join('tb_services', 'tb_services_used.service_id', '=', 'tb_services.service_id')
                ->join('tb_type_service', 'tb_services.type_id', '=', 'tb_type_service.type_id')
                ->join('tb_house', 'tb_rooms.house_id', '=', 'tb_house.house_id')
                ->where('tb_house.user_id', auth()->user()->id)
                ->where('tb_services.type_id', 1)
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
        }
        return $electricityBill;
    }

    public function getCostsIncurred($month, $house)
    {
        if ($house != 'all-house') {
            $costsIncurred = DB::table('tb_costs_incurred')
                ->join('tb_rental_room', 'tb_costs_incurred.rental_room_id', '=', 'tb_rental_room.rental_room_id')
                ->join('tb_rooms', 'tb_rental_room.room_id', '=', 'tb_rooms.room_id')
                ->join('tb_house', 'tb_rooms.house_id', '=', 'tb_house.house_id')
                ->where('tb_house.user_id', auth()->user()->id)
                ->where('tb_house.house_id', $house)
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
        } else {
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
        }
        return $costsIncurred;
    }

    public function getOtherServicesUsed()
    {
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

        return $otherServicesUsed;
    }

    public function getData($waterBills, $electricityBill, $costsIncurred, $otherServicesUsed)
    {
        $data = [];

        foreach ($waterBills as $waterBill) {
            foreach ($electricityBill as $electricity) {
                if ($waterBill->room_id == $electricity->room_id) {

                    // NOTE: Create a new object to store the data
                    $result = new \stdClass();

                    // NOTE: Get the room's, house's, and tenant's information 
                    $result->rental_room_id = $waterBill->rental_room_id;
                    $result->house_name = $waterBill->house_name;
                    $result->house_address = $waterBill->house_address;
                    $result->room_name = $waterBill->room_name;
                    $result->room_price = $waterBill->price;
                    $result->tenant_name = $waterBill->fullname;
                    $result->tenant_phone = $waterBill->phone_number;
                    $result->tenant_email = $waterBill->email;

                    // NOTE: Get the water and electricity price
                    $result->waterServicePrice = $waterBill->price_if_changed;
                    $result->electricityServicePrice = $electricity->price_if_changed;

                    // NOTE: Get bill date
                    $result->billDate = $waterBill->date;

                    // NOTE: Get the water and electricity index (old and new)
                    $result->old_water_index = $waterBill->old_water_index;
                    $result->new_water_index = $waterBill->new_water_index;
                    $result->old_electricity_index = $electricity->old_electricity_index;
                    $result->new_electricity_index = $electricity->new_electricity_index;

                    // NOTE: Calculate the water and electricity consume
                    $result->waterConsume = $waterBill->new_water_index - $waterBill->old_water_index;
                    $result->electricityConsume = $electricity->new_electricity_index - $electricity->old_electricity_index;

                    // NOTE: Calculate the water and electricity total price
                    $result->waterTotalPrice = $result->waterConsume * $result->waterServicePrice;
                    $result->electricityTotalPrice = $result->electricityConsume * $result->electricityServicePrice;

                    // NOTE: Get the costs incurred if any
                    if (collect($costsIncurred)->where('rental_room_id', $waterBill->rental_room_id)->count() > 0) {
                        $result->costsIncurred = collect($costsIncurred)->where('rental_room_id', $waterBill->rental_room_id)->toArray();
                    } else {
                        $result->costsIncurred = [];
                    }

                    // NOTE: Get the other services used if any
                    if (collect($otherServicesUsed)->where('rental_room_id', $waterBill->rental_room_id)->count() > 0) {
                        $result->otherServicesUsed = collect($otherServicesUsed)->where('rental_room_id', $waterBill->rental_room_id)->toArray();
                    } else {
                        $result->otherServicesUsed = [];
                    }

                    // NOTE: Calculate the total price (water + electricity + room price + costs incurred + other services used)
                    $result->total = $result->waterTotalPrice + $result->electricityTotalPrice +
                        $result->room_price + collect($result->costsIncurred)->sum('price') +
                        collect($result->otherServicesUsed)->sum('price_if_changed');

                    // NOTE: Save the room billing to database
                    if (RoomBilling::where('rental_room_id', $result->rental_room_id)->where('date', $result->billDate)->count() == 0) {
                        $roomBilling = new RoomBilling();
                        $roomBilling->total_price = $result->total;
                        $roomBilling->rental_room_id = $result->rental_room_id;
                        $roomBilling->date = $result->billDate;
                        $roomBilling->save();
                    }

                    // NOTE: Push the result to the data array
                    $data[] = $result;
                    break;
                }
            }
        }

        return $data;
    }
}
