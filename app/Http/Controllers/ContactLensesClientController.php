<?php

namespace App\Http\Controllers;

use App\Models\Contact_lenses_client;
use App\Models\Contact_lenses_exam;
use Illuminate\Http\Request;

class ContactLensesClientController extends Controller
{
    public function searchContactLensesClients()
    {
        $all_clients = Contact_lenses_client::all();
        $request = request()->name;
        $name_exists = Contact_lenses_client::where('name','like','%'.$request.'%')->exists();
        $phone_exists = Contact_lenses_client::where('phone','like','%'.$request.'%')->exists();

        if ($name_exists && $request != ""){
            $search_clients = Contact_lenses_client::where('name','like','%'.$request.'%')->get();//carobna linija koda
            return view('homeContactLenses', compact('search_clients', 'all_clients'));
        }elseif ($phone_exists){
            $search_clients = Contact_lenses_client::where('phone','like','%'.$request.'%')->get();//carobna linija koda
            return view('homeContactLenses', compact('search_clients', 'all_clients'));
        }elseif ($request == ""){
            return view('homeContactLenses', compact('all_clients'));
        }
        elseif (Contact_lenses_client::where('name','like','%'.$request.'%')->exists() == false){
            return view('homeContactLenses', compact('all_clients'));

        }
    }

    public function saveContactLensesForm(Request $request,$id)
    {
        $contact_lenses_client = Contact_lenses_client::find($id);

        $request->validate([
            'right_diopter'=>'required',
            'right_diopter2'=>'required',
            'right_axis'=>'required',

            'left_diopter'=>'required',
            'left_diopter2'=>'required',
            'left_axis'=>'required',
        ]);
        $new_cl_examination = new Contact_lenses_exam();
        $new_cl_examination->right_eye_sphere = $request->right_diopter;
        $new_cl_examination->right_eye_cylinder = $request->right_diopter2;
        $new_cl_examination->right_eye_axis = $request->right_axis;
        $new_cl_examination->right_eye_add = $request->right_add;

        $new_cl_examination->left_eye_sphere = $request->left_diopter;
        $new_cl_examination->left_eye_cylinder = $request->left_diopter2;
        $new_cl_examination->left_eye_axis = $request->left_axis;
        $new_cl_examination->left_eye_add = $request->left_add;

        $new_cl_examination->producer = $request->producer;
        $new_cl_examination->type = $request->type;
        $new_cl_examination->base_curve = $request->base_curve;
        $new_cl_examination->diameter = $request->diameter;
        $new_cl_examination->material = $request->material;
        $new_cl_examination->packaging = $request->packaging;
        $new_cl_examination->maximum_use = $request->maximum_use;
        //$new_examination->near_right_eye = (!is_null($request->near_right_eye) ? $request->near_right_eye : "");

        if ($request->green){
            $new_cl_examination->exam = $request->green;
        }else{
            $new_cl_examination->exam = $request->red;
        }
        $new_cl_examination->contact_lenses_client_id = $contact_lenses_client->id;
        $new_cl_examination->save();

        return redirect()->action([HomeController::class,'showContactLensesExaminationForm'],['id'=>$contact_lenses_client->id])->
        with('message','New data sent');

    }

    public function edit($id)
    {
        $client = Contact_lenses_client::find($id);

        return view('editContactLensesClient', compact('client'));
    }

    public function update(Request $request, $id)
    {
        $client = Contact_lenses_client::find($id);

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

        return redirect('/home-contact-lenses');
    }


}
