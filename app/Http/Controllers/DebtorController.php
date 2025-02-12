<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Debtor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function searchDebtClient()
    {
        $all_debtors = Debtor::all();
        $request = request()->name;
        $name_exists = Debtor::where('name','like','%'.$request.'%')->exists();//ako postoji ukucan termin
        $phone_exists = Debtor::where('client_phone','like','%'.$request.'%')->exists();

        if ($name_exists && $request != ""){
            $search_clients = Debtor::where('name','like','%'.$request.'%')->get();//carobna linija koda
            return view('home.allDebtors', compact('search_clients', 'all_debtors'));
        }elseif ($phone_exists && $request != ""){
            $search_clients = Debtor::where('client_phone','like','%'.$request.'%')->get();//carobna linija koda
            return view('home.allDebtors', compact('search_clients', 'all_debtors'));
        }elseif ($request == ""){
            return view('home.allDebtors', compact('all_debtors'));
        }
        elseif ($name_exists == false || $phone_exists == false){
            return view('home.allDebtors', compact('all_debtors'));

        }

    }

    public function unpaidDebt()
    {
        $all_debtors = Debtor::all();
        $unpaidDebtors = Debtor::select('debtors.*')
            ->selectRaw('(SELECT COALESCE(SUM(payment), 0) FROM payments WHERE payments.debtor_id = debtors.id) as total_paid')
            ->whereRaw('debit > (SELECT COALESCE(SUM(payment), 0) FROM payments WHERE payments.debtor_id = debtors.id)')
            ->get(); //ovaj upit je iz chatGPT

        return view('home.allDebtors', compact('all_debtors','unpaidDebtors'));
    }


}
