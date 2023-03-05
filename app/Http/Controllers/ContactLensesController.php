<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Contact_lense;
use App\Models\Contact_lenses_client;
use App\Models\Diopter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ContactLensesController extends Controller
{
    public function index()
    {
        $contact_lenses = Contact_lense::all();
        return view('home.showContactLensesExaminationForm',compact('contact_lenses'));
    }


    public function searchContactLensesType($id)
    {
        $contact_lenses = Contact_lense::all();
        $single_client = Contact_lenses_client::find($id);
        $all_diopters = Diopter::all();
        $request = request()->type;
        if (Contact_lense::where('type','like','%'.request()->type.'%')->exists() && $request != ""){
            $search_contact_lenses = Contact_lense::where('type','like','%'.request()->type.'%')->get();//carobna linija koda
            return view('home.showContactLensesExaminationForm', compact('search_contact_lenses', 'all_diopters','single_client','contact_lenses'));
        }elseif ($request == ""){
            return view('home.showContactLensesExaminationForm', compact('all_diopters','single_client','contact_lenses'));
        }
        elseif (Contact_lense::where('type','like','%'.request()->type.'%')->exists() == false){
            return view('home.showContactLensesExaminationForm', compact('all_diopters','single_client','contact_lenses'));

        }
    }

    public function suitableContactLenses($id,$client_id)
    {
        $suitable_contact_lenses = Contact_lense::find($id);
        $single_client = Contact_lenses_client::find($client_id);
        $all_diopters = Diopter::all();
        $contact_lenses = Contact_lense::all();

        return view('home.showContactLensesExaminationForm', compact('suitable_contact_lenses','single_client','all_diopters','contact_lenses'));
    }

}
