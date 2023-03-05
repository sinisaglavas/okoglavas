<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Debtor;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class PaymentController extends Controller
{


    public function savePaymentForm(Request $request,$id)
    {
        $request->validate(['payment'=>'required']);
        $debtor = Debtor::find($id);

        $payment = new Payment();
        $payment->payment = $request->payment;
        $payment->debtor_id = $debtor->id;
        $payment->save();

        return redirect()->back();
    }



}
