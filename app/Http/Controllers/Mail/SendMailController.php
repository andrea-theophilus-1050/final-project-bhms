<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Calculation\RoomBillingController;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendBillViaEmail;

class SendMailController extends Controller
{
    public function sendMailBill($month, $house)
    {
        $roomBilling = new RoomBillingController();

        $waterBills = $roomBilling->getWaterBills($month, $house);

        $electricityBills = $roomBilling->getElectricityBills($month, $house);

        $costsIncurred = $roomBilling->getCostsIncurred($month, $house);

        $otherServicesUsed = $roomBilling->getOtherServicesUsed($month, $house);

        $data = $roomBilling->getData($waterBills, $electricityBills, $costsIncurred, $otherServicesUsed);

        try {
            foreach ($data as $bill) {
                // send bill via email
                Mail::to($bill->tenant_email)->send(new SendBillViaEmail($bill));
            }
            return redirect()->back()->with('success', 'Send bill via email successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
