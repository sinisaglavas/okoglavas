<?php

namespace App\Http\Controllers;

use App\Models\Debtors_contact_lenses;
use App\Models\PaymentContactLense;
use Illuminate\Http\Request;

class PaymentContactLenseController extends Controller
{
    public function savePaymentContactLensesForm(Request $request, $id)
    {
        $request->validate(['payment'=>'required']);

        $debtor = Debtors_contact_lenses::find($id);
        $payment = new PaymentContactLense();
        $payment->payment = $request->payment;
        $payment->debtors_contact_lenses_id = $debtor->id;
        $payment->save();

        return redirect()->back();
    }

}
