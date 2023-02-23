<?php

namespace App\Http\Controllers\Calculation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CalculationWaterElectricityController extends Controller
{
    public function water()
    {
        return view('dashboard.calculation.water')->with('title', 'Water Calculation');
    }

    public function electric()
    {
        return view('dashboard.calculation.electric')->with('title', 'Electricity Calculation');
    }

    public function costs_incurred()
    {
        return view('dashboard.calculation.costs-incurred')->with('title', 'Costs Incurred');
    }

    public function room_billing()
    {
        return view('dashboard.calculation.room-billing')->with('title', 'Room Billing');
    }
}
