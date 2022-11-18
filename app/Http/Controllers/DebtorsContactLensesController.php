<?php

namespace App\Http\Controllers;

use App\Models\Contact_lenses_client;
use App\Models\Debtors_contact_lenses;
use App\Models\PaymentContactLense;
use Illuminate\Http\Request;

class DebtorsContactLensesController extends Controller
{
    public function index()
    {
        $all_debtors = Debtors_contact_lenses::all();

        return view('allDebtorsContactLenses', compact('all_debtors'));
    }

    public function showDebtorContactLensesForm()
    {
        $all_clients = Contact_lenses_client::all();

        //$payment = Payment::where('client_id',$id)->get();

        return view('showDebtorContactLensesForm',compact('all_clients'));
    }

    public function saveDebtorContactLensesForm(Request $request)
    {
        $request->validate(['debit'=>'required']);
        $client = Contact_lenses_client::find($request->client);//svi podaci od klijenta, client == id
        $debtor = new Debtors_contact_lenses();

        $debtor->name = $client->name;
        $debtor->client_phone = $client->phone;
        $debtor->debit = $request->debit;//dug od klijenta
        $debtor->client_id = $client->id;
        $debtor->save();
        return redirect()->back()->with('message','New data sent');
    }

    public function showSingleDebtorContactLenses($id)
    {
        $debtor = Debtors_contact_lenses::find($id);
        //$payments = PaymentContactLense::where('debtors_contact_lenses_id',$id)->get();
        $payments = $debtor->paymentContactLenses;//has many relation
        $debtors = Debtors_contact_lenses::where('id',$id)->get();

        return view('showSingleDebtorContactLenses',compact('debtor','payments','debtors'));
    }
}
