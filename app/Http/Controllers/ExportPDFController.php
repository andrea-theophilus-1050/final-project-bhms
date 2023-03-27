<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Calculation\RoomBillingController;

class ExportPDFController extends Controller
{
    public function exportPDF($month, $house)
    {
        $roomBilling = new RoomBillingController();

        $waterBills = $roomBilling->getWaterBills($month, $house);

        $electricityBills = $roomBilling->getElectricityBills($month, $house);

        $costsIncurred = $roomBilling->getCostsIncurred($month, $house);

        $otherServicesUsed = $roomBilling->getOtherServicesUsed($month, $house);

        $data = $roomBilling->getData($waterBills, $electricityBills, $costsIncurred, $otherServicesUsed);

        /** @var \Barryvdh\DomPDF\PDF $pdf */
        $pdf = \PDF::loadView('pdf.room-bills', compact(['data', 'month']));
        return $pdf->download('Room bills ' . $month . '.pdf');
    }
}
