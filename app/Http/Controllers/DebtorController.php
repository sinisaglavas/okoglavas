<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Debtor;
use Illuminate\Http\Request;

class DebtorController extends Controller
{
    public function index()
    {
        $all_debtors = Debtor::all();

        return view('home.allDebtors',compact('all_debtors'));
    }

    public function showDebtorForm()
    {
        $all_clients = Client::all();

        return view('showDebtorForm',compact('all_clients'));
    }


    public function saveDebtorForm(Request $request)
    {
        $request->validate(['debit'=>'required']);
        $client = Client::find($request->client);//svi podaci od klijenta
        $debtor = new Debtor();

        $debtor->name = $client->name;
        $debtor->client_phone = $client->phone;
        $debtor->debit = $request->debit;//dug od klijenta
        $debtor->client_id = $client->id;
        $debtor->save();
        return redirect()->back()->with('message','New data sent');


    }

    public function showSingleDebtor($id)
    {
        $debtor = Debtor::find($id);
        $payments = $debtor->payments;//has many relation
        $debtors = Debtor::where('id',$id)->get();

        return view('home.showSingleDebtor',compact('debtor','payments','debtors'));
    }

    public function saveAddDebtorForm(Request $request,$id)
    {
        $client = Client::find($id);
        $debtor = new Debtor();
        $debtor->name = $client->name;
        $debtor->client_phone = $client->phone;
        $debtor->debit = $request->debit;//dug od klijenta
        $debtor->client_id = $client->id;
        $debtor->save();


        return redirect()->back()->with('message','New data sent');
    }

}
