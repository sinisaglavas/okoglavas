<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Contact_lenses_client;
use App\Models\Diopter;
use App\Models\Dist_pupillary;
use App\Models\Distance;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {

        return view('welcome');
    }

    public function searchClient()
    {
        $all_clients = Client::all();
        $request = request()->name;
        $name_exists = Client::where('name','like','%'.$request.'%')->exists();
        $phone_exists = Client::where('phone','like','%'.$request.'%')->exists();

        if ($name_exists && $request != ""){
            $search_clients = Client::where('name','like','%'.$request.'%')->get();//carobna linija koda
            return view('homeGlasses', compact('search_clients', 'all_clients'));
        }elseif ($phone_exists && $request != ""){
            $search_clients = Client::where('phone','like','%'.$request.'%')->get();//carobna linija koda
            return view('homeGlasses', compact('search_clients', 'all_clients'));
        }elseif ($request == ""){
            return view('homeGlasses', compact('all_clients'));
        }
        elseif ($name_exists == false || $phone_exists == false){
            return view('homeGlasses', compact('all_clients'));

        }

    }

    public function edit($id)
    {
        $client = Client::find($id);

        return view('editClient', compact('client'));
    }

    public function update(Request $request, $id)
    {
        $client = Client::find($id);

        $pureData = $request->validate([
            'name'=>'required',
            'phone'=>'required | max:14'],
            ['phone.max'=>'Ne mozete uneti vise od 14 cifara'
        ]);

        $client->name = $request->name;
        $client->date_of_birth = (!is_null($request->date_of_birth) ? $request->date_of_birth : "");
        $client->address = (!is_null($request->address) ? $request->address : "");//ako nema unosa ostavi prazno polje
        $client->city = (!is_null($request->city) ? $request->city : "");
        $client->phone = $request->phone;
        $client->identity_card = $request->identity_card;
        $client->update();

        return redirect('/home-glasses');
    }

    public function editDistanceForm($distance_id)
    {
        $single_distance = Distance::find($distance_id);
        $single_client = Client::find($single_distance->client_id);
        $all_diopters = Diopter::all();
        $all_pd = Dist_pupillary::all();

        return view('editClientExamination', compact('single_distance','single_client', 'all_diopters', 'all_pd'));
    }

    public function updateDistanceForm(Request $request,$id)
    {
        $single_client = Client::find($id);

        $request->validate([
            'right_diopter'=>'required',
            'right_diopter2'=>'required',
            'right_axis'=>'required',
            'right_eye_pd'=>'required',
            'left_diopter'=>'required',
            'left_diopter2'=>'required',
            'left_axis'=>'required',
            'left_eye_pd'=>'required'
        ]);
        $new_examination = new Distance();
        $new_examination->right_eye_sphere = $request->right_diopter;
        $new_examination->right_eye_cylinder = $request->right_diopter2;
        $new_examination->right_eye_axis = $request->right_axis;
        $new_examination->right_eye_pd = $request->right_eye_pd;
        $new_examination->left_eye_sphere = $request->left_diopter;
        $new_examination->left_eye_cylinder = $request->left_diopter2;
        $new_examination->left_eye_axis = $request->left_axis;
        $new_examination->left_eye_pd = $request->left_eye_pd;
        if ($request->green){
            $new_examination->exam = $request->green;
        }else{
            $new_examination->exam = $request->red;
        }
        $new_examination->client_id = $single_client->id;


//        $new_examination->near_right_eye = (!is_null($request->near_right_eye) ? $request->near_right_eye : "");
//        $new_examination->near_left_eye = (!is_null($request->near_left_eye) ? $request->near_left_eye : "");
//        $new_examination->near_pd = (!is_null($request->near_pd) ? $request->near_pd : "");

        $new_examination->save();

        return redirect()->back()->with('message','New data sent');

    }

}
