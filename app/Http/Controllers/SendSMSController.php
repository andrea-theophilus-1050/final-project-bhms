<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;
use App\Http\Controllers\Calculation\RoomBillingController;

class SendSMSController extends Controller
{
    public function sendSMS($month, $house)
    {
        try {
            $sid = env('TWILIO_SID');
            $token = env('TWILIO_TOKEN');
            $numberFrom = env('TWILIO_FROM');

            $client = new Client($sid, $token);

            $roomBilling = new RoomBillingController();

            $waterBills = $roomBilling->getWaterBills($month, $house);

            $electricityBills = $roomBilling->getElectricityBills($month, $house);

            $costsIncurred = $roomBilling->getCostsIncurred($month, $house);

            $otherServicesUsed = $roomBilling->getOtherServicesUsed($month, $house);

            $data = $roomBilling->getData($waterBills, $electricityBills, $costsIncurred, $otherServicesUsed);


            foreach ($data as $bill) {
                // NOTE: This is a free Twilio trial account, so I only send SMS to my own phone number "+84398371050"
                // NOTE: Remove if-else code when the Twilio account is upgraded to a paid account

                if ($bill->tenant_phone != '+84398371050') {
                    continue;
                } else {
                    $client->messages->create(
                        $bill->tenant_phone,
                        [
                            'from' => $numberFrom,
                            'body' => chr(10) . 'Hello: ' . $bill->tenant_name . chr(10) . chr(10) . // chr(10) is a new line
                                'Your bill for the month of ' . $bill->billDate . ' is: ' . number_format($bill->total, 0, ',', ',') . ' VND' . chr(10) . chr(10) .
                                'Please access to the system to view detail: ' . url('/') . '/tenant/login'
                        ]
                    );
                }
            }

            return redirect()->back()->with('success', 'Send bill via SMS successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error',  'Message could not be sent. Error: ' . $e->getMessage());
        }
    }
}
