<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VNPayPayment;

class PaymentVNPayController extends Controller
{
    public function index()
    {
        $payments = VNPayPayment::where('user_id', auth()->user()->id)->get();
        return view('dashboard.vnpay-payment.index', compact(['payments']))->with('title', 'Payment method');
    }

    public function store(Request $request)
    {
        $payment = new VNPayPayment();
        $payment->vnp_TmnCode = $request->input('vnp_TmnCode');
        $payment->vnp_HashSecret = $request->input('vnp_HashSecret');
        $payment->user_id = auth()->user()->id;
        $payment->save();

        return redirect()->route('payment.index')->with('success', 'Insert data successfully');
    }

    public function update(Request $request, $id)
    {
        $payment = VNPayPayment::find($id);
        $payment->vnp_TmnCode = $request->input('vnp_TmnCode');
        $payment->vnp_HashSecret = $request->input('vnp_HashSecret');
        $payment->user_id = auth()->user()->id;
        $payment->save();

        return redirect()->route('payment.index')->with('success', 'Update data successfully');
    }

    public function destroy($id)
    {
        $payment = VNPayPayment::find($id);
        $payment->delete();

        return redirect()->route('payment.index')->with('success', 'Delete data successfully');
    }
}
