<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Debtor;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Model;
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

        //$payment = Payment::where('client_id',$id)->get();

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
        //$payments = Payment::where('debtor_id',$id)->get();
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















//    public function saveDebtorForm(Request $request)
//    {
//        $request->validate([
//            'debit'=>'required'
//        ]);
//
//        $client = Client::find($request->client);//svi podaci od klijenta
//
//        $result = DB::table('debtors')->where('client_id',$client->id)->get();//jedan rezultat sa index-om 0
//        if ($result[0]->client_id == $client->id){
//            return redirect()->back()->with('message','The debtor exists in the database');
//        }

//        if ($result[0]->client_id == $client->id ){
//            $debt = Debtor::find($result[0]->id);
//            $debt->debit = $debt->debit + $request->debit;
//            $debt->update();
//        }else{
//            $debtor = new Debtor();
//
//            $debtor->name = $client->name;
//            $debtor->debit = $request->debit;//dug od klijenta
//            $debtor->client_identity_card = $client->identity_card;//licna karta klijenta
//            $debtor->client_id = $client->id;
//            $debtor->save();
//        }

        //       Debtor::where('client_id',$client->id)->exists()

//            if(auth()->user()->activeCode()->where('code', $data['token'])->exists()){
//                dd('same');


        // return redirect()->back()->with('message','New data sent');

        //$search = Client::where('name', 'LIKE', '%' . $request->search. '%')->get();

  //  }




}
