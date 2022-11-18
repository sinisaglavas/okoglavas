<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Contact_lenses_client;
use App\Models\Contact_lenses_exam;
use Illuminate\Http\Request;

class ContactLensesClientController extends Controller
{
    public function searchContactLensesClients()
    {
        $all_clients = Contact_lenses_client::all();
        $request = request()->name;
        if (Contact_lenses_client::where('name','like','%'.request()->name.'%')->exists() && $request != ""){
            $search_clients = Contact_lenses_client::where('name','like','%'.request()->name.'%')->get();//carobna linija koda
            return view('homeContactLenses', compact('search_clients', 'all_clients'));
        }elseif ($request == ""){
            return view('homeContactLenses', compact('all_clients'));
        }
        elseif (Contact_lenses_client::where('name','like','%'.request()->name.'%')->exists() == false){
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

        $new_cl_examination->left_eye_sphere = $request->left_diopter;
        $new_cl_examination->left_eye_cylinder = $request->left_diopter2;
        $new_cl_examination->left_eye_axis = $request->left_axis;

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


}
