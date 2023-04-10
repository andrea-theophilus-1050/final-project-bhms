<?php

namespace App\Http\Controllers\TenantRole;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\RoomBilling;
use App\Models\RentalRoom;
use Illuminate\Support\Facades\DB;
use Nette\Utils\DateTime;
use App\Models\Notification;

class HandleTenantController extends Controller
{
    public function index()
    {
        $roomBillings = RentalRoom::with('tenants', 'roomBills', 'waterBills', 'electricityBills', 'costIncurred', 'servicesUsed')
            ->where('tenant_id', auth('tenants')->user()->tenant_id)
            ->first();

        $data = new \stdClass();
        $data->rental_room_id = $roomBillings->rental_room_id;
        $data->house_name = $roomBillings->rooms->houses->house_name;
        $data->house_address = $roomBillings->rooms->houses->house_address;
        $data->room_name = $roomBillings->rooms->room_name;
        $data->room_price = $roomBillings->rooms->price;
        $data->tenant_name = $roomBillings->tenants->fullname;
        $data->tenant_phone = $roomBillings->tenants->phone_number;
        $data->tenant_email = $roomBillings->tenants->email;

        $data->roomBills = $roomBillings->roomBills;

        $waterServicePrice = DB::table('tb_services_used')
            ->join('tb_services', 'tb_services.service_id', '=', 'tb_services_used.service_id')
            ->join('tb_type_service', 'tb_type_service.type_id', '=', 'tb_services.type_id')
            ->where('tb_type_service.type_id', 2)
            ->where('tb_services_used.rental_room_id', $roomBillings->rental_room_id)
            ->value('tb_services_used.price_if_changed');
        $data->waterServicePrice = $waterServicePrice;

        $electricityServicePrice = DB::table('tb_services_used')
            ->join('tb_services', 'tb_services.service_id', '=', 'tb_services_used.service_id')
            ->join('tb_type_service', 'tb_type_service.type_id', '=', 'tb_services.type_id')
            ->where('tb_type_service.type_id', 1)
            ->where('tb_services_used.rental_room_id', $roomBillings->rental_room_id)
            ->value('tb_services_used.price_if_changed');
        $data->electricityServicePrice = $electricityServicePrice;

        foreach ($roomBillings->waterBills as $water) {
            $waterBill = new \stdClass();

            $waterBill->date = $water->date;
            $waterBill->old_water_index = $water->old_water_index;
            $waterBill->new_water_index = $water->new_water_index;

            $waterBill->waterConsumed = $water->new_water_index - $water->old_water_index;
            $waterBill->waterTotalPrice = $waterServicePrice * $waterBill->waterConsumed;

            $data->waterBills[] = $waterBill;
        }

        foreach ($roomBillings->electricityBills as $electricity) {
            $electricityBill = new \stdClass();

            $electricityBill->date = $electricity->date;
            $electricityBill->old_electricity_index = $electricity->old_electricity_index;
            $electricityBill->new_electricity_index = $electricity->new_electricity_index;

            $electricityBill->electricityConsumed = $electricity->new_electricity_index - $electricity->old_electricity_index;
            $electricityBill->electricityTotalPrice = $electricityServicePrice * $electricityBill->electricityConsumed;

            $data->electricityBills[] = $electricityBill;
        }

        if ($roomBillings->costIncurred->count() > 0) {
            foreach ($roomBillings->costIncurred as $cost) {
                $costIncurred = new \stdClass();

                $costIncurred->date = $cost->date;
                $costIncurred->reason = $cost->reason;
                $costIncurred->price = $cost->price;

                $data->costIncurred[] = $costIncurred;
            }
        } else {
            $data->costIncurred = null;
        }

        if ($roomBillings->servicesUsed->count() > 0) {
            foreach ($roomBillings->servicesUsed as $service) {
                $servicesUsed = new \stdClass();

                if ($service->service->type_id != 1 && $service->service->type_id != 2) {
                    $servicesUsed->service_name = $service->service->service_name;
                    $servicesUsed->price = $service->price_if_changed;

                    $data->servicesUsed[] = $servicesUsed;
                } else {
                    $data->servicesUsed = null;
                }
            }
        } else {
            $data->servicesUsed = null;
        }


        // return Pretty json
        // return response()->json($data, 200, [], JSON_PRETTY_PRINT);
        return view('tenants-pages.index', compact(['data']))->with('title', 'Tenant Dashboard');
    }

    public function feedback()
    {
        $feedbacks = Feedback::where('tenant_id', auth('tenants')->user()->tenant_id)->orderBy('created_at', 'desc')->orderBy('status', 'desc')->paginate(10);
        return view('tenants-pages.feedback', compact(['feedbacks']))->with('title', 'Tenant Feedback');
    }

    public function sendFeedback(Request $request)
    {

        $feedback = new Feedback();
        $feedback->content = $request->contentFeedback;
        $feedback->tenant_id = auth('tenants')->user()->tenant_id;
        $feedback->save();

        return redirect()->route('role.tenants.feedback')->with('success', 'Feedback sent successfully!');
    }

    public function updateFeedback(Request $request, $id)
    {
        $feedback = Feedback::find($id);
        $feedback->content = $request->contentFeedback;
        $feedback->created_at = now();
        $feedback->save();

        return redirect()->route('role.tenants.feedback')->with('success', 'Feedback updated successfully!');
    }

    public function deleteFeedback($id)
    {
        $feedback = Feedback::find($id);
        $feedback->delete();

        return redirect()->route('role.tenants.feedback')->with('success', 'Feedback deleted successfully!');
    }


    public function paymentStatus()
    {
        $vnp_Url = 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html';
        $vnp_Returnurl = 'https://boardinghouse-management-system.me/tenants/payment-status';
        $vnp_TmnCode = auth('tenants')->user()->user->paymentVNPay->vnp_TmnCode; //Mã website tại VNPAY
        $vnp_HashSecret = auth('tenants')->user()->user->paymentVNPay->vnp_HashSecret; //Chuỗi bí mật

        $vnp_SecureHash = $_GET['vnp_SecureHash'];
        $inputData = [];
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == 'vnp_') {
                $inputData[$key] = $value;
            }
        }

        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = '';
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . '=' . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . '=' . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        $billID = $_GET['vnp_TxnRef'];
        $totalPrice = $_GET['vnp_Amount'] / 100;
        $responseCode = $_GET['vnp_ResponseCode'];
        $paymentDesc = $_GET['vnp_OrderInfo'];
        $transactionNo = $_GET['vnp_TransactionNo'];

        $dt = DateTime::createFromFormat('YmdHis', $_GET['vnp_PayDate']);
        $paymentTime = $dt->format('F d, Y - H:i:s a');

        if ($responseCode == '00') {
            $roomBilling = RoomBilling::find($billID);
            $roomBilling->paidAmount = $totalPrice;
            $roomBilling->status = 1;
            $roomBilling->save();

            // check exists notification
            $checkNotification = Notification::where('url', $roomBilling->id)->first();
            if (!$checkNotification) {
                $notification = new Notification();
                $notification->content = $roomBilling->rentalRoom->tenants->fullname . ' has paid for bill ' . $roomBilling->date;
                $notification->user_id = $roomBilling->rentalRoom->rooms->houses->users->id;
                $notification->url = $roomBilling->id;
                $notification->save();
            }
        }

        return view('tenants-pages.payment-status', compact([
            'billID',
            'totalPrice',
            'responseCode',
            'paymentDesc',
            'transactionNo',
            'paymentTime',
            'vnp_SecureHash',
            'secureHash',
        ]))->with('title', 'Payment Status');
    }

    public function updateBillStatus(Request $request)
    {
        $roomBilling = RoomBilling::find($request->billID);
        $roomBilling->paidAmount = $request->paidAmount;
        $roomBilling->status = 1;
        $roomBilling->save();

        // check exists notification
        $checkNotification = Notification::where('url', $roomBilling->id)->first();
        if (!$checkNotification) {
            $notification = new Notification();
            $notification->content = $roomBilling->rentalRoom->tenants->name . ' has paid for bill ' . $roomBilling->date;
            $notification->user_id = $roomBilling->rentalRoom->rooms->houses->users->id;
            $notification->url = $roomBilling->id;
            $notification->save();
        }

        return redirect()->route('role.tenants.index');
    }

    public function clearNotification()
    {
        $notifications = Notification::where('tenant_id', auth('tenants')->user()->tenant_id)->get();
        foreach ($notifications as $notification) {
            $notification->delete();
        }
        return redirect()->back();
    }
}
