<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Contact_lenses_client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $all_clients = Client::all();
        $all_contact_lenses_clients = Contact_lenses_client::all();

        return view('welcome',compact('all_clients','all_contact_lenses_clients'));
    }

    public function searchClient()
    {
        $all_clients = Client::all();
        $request = request()->name;

        if (Client::where('name','like','%'.request()->name.'%')->exists() && $request != ""){
            $search_clients = Client::where('name','like','%'.request()->name.'%')->get();//carobna linija koda
            return view('homeGlasses', compact('search_clients', 'all_clients'));
        }elseif ($request == ""){
            return view('homeGlasses', compact('all_clients'));
        }
        elseif (Client::where('name','like','%'.request()->name.'%')->exists() == false){
            return view('homeGlasses', compact('all_clients'));

        }

    }

}
