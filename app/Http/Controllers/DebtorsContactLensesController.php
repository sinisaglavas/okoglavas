<?php

namespace App\Http\Controllers;

use App\Models\Contact_lenses_client;
use App\Models\Debtors_contact_lenses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $payments = $debtor->paymentContactLenses;//has many relation
        $debtors = Debtors_contact_lenses::where('id',$id)->get();

        return view('showSingleDebtorContactLenses',compact('debtor','payments','debtors'));
    }

    public function searchDebtClient()
    {
        $all_debtors = Debtors_contact_lenses::all();
        $request = request()->name;
        $name_exists = Debtors_contact_lenses::where('name', 'like', '%' . $request . '%')->exists();//ako postoji ukucan termin
        $phone_exists = Debtors_contact_lenses::where('client_phone', 'like', '%' . $request . '%')->exists();

        if ($name_exists && $request != "") {
            $search_clients = Debtors_contact_lenses::where('name', 'like', '%' . $request . '%')->get();//carobna linija koda
            return view('allDebtorsContactLenses', compact('search_clients', 'all_debtors'));
        } elseif ($phone_exists && $request != "") {
            $search_clients = Debtors_contact_lenses::where('client_phone', 'like', '%' . $request . '%')->get();//carobna linija koda
            return view('allDebtorsContactLenses', compact('search_clients', 'all_debtors'));
        } elseif ($request == "") {
            return view('allDebtorsContactLenses', compact('all_debtors'));
        } elseif ($name_exists == false || $phone_exists == false) {
            return view('allDebtorsContactLenses', compact('all_debtors'));

        }
    }

    public function unpaidDebtCL()
    {
        $all_debtors = Debtors_contact_lenses::all();
        $unpaidDebtors = Debtors_contact_lenses::select('debtors_contact_lenses.*')
            ->selectRaw('(SELECT COALESCE(SUM(payment), 0) FROM payment_contact_lenses WHERE payment_contact_lenses.debtors_contact_lenses_id = debtors_contact_lenses.id) as total_paid')
            ->whereRaw('debit > (SELECT COALESCE(SUM(payment), 0) FROM payment_contact_lenses WHERE payment_contact_lenses.debtors_contact_lenses_id = debtors_contact_lenses.id)')
            ->get(); //ovaj upit je iz chatGPT

        return view('allDebtorsContactLenses', compact('all_debtors','unpaidDebtors'));
    }
}
