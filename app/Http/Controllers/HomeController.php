<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Contact_lens;
use App\Models\Contact_lense;
use App\Models\Contact_lenses_client;
use App\Models\Contact_lenses_exam;
use App\Models\Diopter;
use App\Models\Dist_pupillary;
use App\Models\Distance;
use App\Models\Examination;
use App\Models\Payment;
use App\Models\Proximity;
use App\Models\Stock;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function glassesClients()
    {
        $all_clients = Client::all();

        return view('homeGlasses',compact('all_clients'));
    }

    public function contactLensesClients()
    {
        $all_clients = Contact_lenses_client::all();

        return view('homeContactLenses', compact('all_clients'));
    }

    public function showClientForm()
    {
        return view('home.showClientForm');
    }

    public function showContactLensesForm()
    {
        return view('home.showContactLensesForm');
    }

    public function saveClientForm(Request $request)
    {
        $request->validate([
           'name'=>'required',
            'phone'=>'required | max:14'],
            ['phone.max'=>'Ne mozete uneti vise od 14 cifara'

        ]);
        $new_client = new Client();
        $new_client->name = $request->name;
        $new_client->date_of_birth = (!is_null($request->date_of_birth) ? $request->date_of_birth : "");
        $new_client->address = (!is_null($request->address) ? $request->address : "");//ako nema unosa ostavi prazno polje
        $new_client->city = (!is_null($request->city) ? $request->city : "");
        $new_client->phone = $request->phone;
        $new_client->identity_card = $request->identity_card;
        $new_client->save();

        return redirect()->back()->with('message','New client sent');
    }

    public function saveContactLensesClientForm(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'phone'=>'required | max:14'],
            ['phone.max'=>'Ne mozete uneti vise od 14 cifara'
            ]);

        $new_client = new Contact_lenses_client();
        $new_client->name = $request->name;
        $new_client->date_of_birth = (!is_null($request->date_of_birth) ? $request->date_of_birth : "");
        $new_client->address = (!is_null($request->address) ? $request->address : "");//ako nema unosa ostavi prazno polje
        $new_client->city = (!is_null($request->city) ? $request->city : "");
        $new_client->phone = $request->phone;
        $new_client->identity_card = $request->identity_card;
        $new_client->save();

        return redirect()->back()->with('message','New client sent');

    }



    public function showExaminationForm($id)
    {
        $all_diopters = Diopter::all();
        $all_pd = Dist_pupillary::all();
        $single_client = Client::find($id);

        return view('home.showExaminationForm',compact('single_client','all_diopters','all_pd'));
    }

    public function showContactLensesExaminationForm($id)
    {
        $single_client = Contact_lenses_client::find($id);
        $contact_lenses = Contact_lense::all();
        $all_diopters = Diopter::all();

        return view('home.showContactLensesExaminationForm',compact('single_client','contact_lenses','all_diopters'));
    }

    public function showSingleClient($id)
    {
        $single_client = Client::find($id);
        $all_distances = $single_client->distances;
        $all_proximities = $single_client->proximities;

        return view('home.singleClient',compact('single_client','all_distances','all_proximities'));
    }

    public function showSingleContactLensesClient($id)
    {
        $single_client = Contact_lenses_client::find($id);

        $all_contact_lenses_exams = $single_client->contact_lenses_exams;
        //$all_contact_lenses_exams = Contact_lenses_exam::where('contact_lenses_client_id', $id);
        //dd($all_contact_lenses_exams);
        return view('home.singleContactLensesClient',compact('single_client','all_contact_lenses_exams'));


    }


    public function saveDistanceForm(Request $request,$id)
    {
        $single_client = Client::find($id);
        $request->validate([
            'right_diopter'=>'required',
            'right_diopter2'=>'required',
            'right_axis'=>'required',
            'right_pd'=>'required',
            'left_diopter'=>'required',
            'left_diopter2'=>'required',
            'left_axis'=>'required',
            'left_pd'=>'required',
        ]);
        if ($request->note != null)
            $request->validate([
                'note'=>'required|string|max:100'
            ]);
        $new_examination = new Distance();
        $new_examination->right_eye_sphere = $request->right_diopter;
        $new_examination->right_eye_cylinder = $request->right_diopter2;
        $new_examination->right_eye_axis = $request->right_axis;
        $new_examination->right_eye_pd = $request->right_pd;

        $new_examination->left_eye_sphere = $request->left_diopter;
        $new_examination->left_eye_cylinder = $request->left_diopter2;
        $new_examination->left_eye_axis = $request->left_axis;
        $new_examination->left_eye_pd = $request->left_pd;
        $request->note == null ? $new_examination->note = " " : $new_examination->note = $request->note;

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

    public function updateDistance(Request $request, $distance_id)
    {
        $new_distance = Distance::find($distance_id);
        $single_client = Client::find($new_distance->client_id);
        $request->validate([
            'right_diopter'=>'required',
            'right_diopter2'=>'required',
            'right_axis'=>'required',
            'right_pd'=>'required',
            'left_diopter'=>'required',
            'left_diopter2'=>'required',
            'left_axis'=>'required',
            'left_pd'=>'required',
            'note'=>'nullable|string|max:100'
        ]);

        $new_distance->right_eye_sphere = $request->right_diopter;
        $new_distance->right_eye_cylinder = $request->right_diopter2;
        $new_distance->right_eye_axis = $request->right_axis;
        $new_distance->right_eye_pd = $request->right_pd;
        $new_distance->left_eye_sphere = $request->left_diopter;
        $new_distance->left_eye_cylinder = $request->left_diopter2;
        $new_distance->left_eye_axis = $request->left_axis;
        $new_distance->left_eye_pd = $request->left_pd;
        $new_distance->note = $request->note;
        if ($request->green){
            $new_distance->exam = $request->green;
        }else{
            $new_distance->exam = $request->red;
        }
        $new_distance->client_id = $single_client->id;

        $new_distance->update();
        return redirect()->back()->with('message','Dioptrija za daljinu je izmenjena');

    }

    public function updateProximity(Request $request, $proximity_id)
    {
        $new_proximity = Proximity::find($proximity_id);
        $single_client = Client::find($new_proximity->client_id);
        $request->validate([
            'right_diopter'=>'required',
            'right_diopter2'=>'required',
            'right_axis'=>'required',
            'right_pd'=>'required',
            'left_diopter'=>'required',
            'left_diopter2'=>'required',
            'left_axis'=>'required',
            'left_pd'=>'required',
            'note'=>'nullable|string|max:100'
        ]);
        $new_proximity->right_eye_sphere = $request->right_diopter;
        $new_proximity->right_eye_cylinder = $request->right_diopter2;
        $new_proximity->right_eye_axis = $request->right_axis;
        $new_proximity->right_eye_pd = $request->right_pd;
        $new_proximity->left_eye_sphere = $request->left_diopter;
        $new_proximity->left_eye_cylinder = $request->left_diopter2;
        $new_proximity->left_eye_axis = $request->left_axis;
        $new_proximity->left_eye_pd = $request->left_pd;
        $new_proximity->note = $request->note;
        if ($request->green){
            $new_proximity->exam = $request->green;
        }else{
            $new_proximity->exam = $request->red;
        }
        $new_proximity->client_id = $single_client->id;

        $new_proximity->update();
        return redirect()->back()->with('message','Dioptrija za blizinu je izmenjena');
    }

    public function updateContactLensesExam(Request $request, $contact_lenses_exam_id)
    {
        $change_contact_lenses_exam = Contact_lenses_exam::find($contact_lenses_exam_id);
        $change_contact_lenses = Contact_lense::find($request->all_contact_lenses);
        $single_client = Contact_lenses_client::find($change_contact_lenses_exam->contact_lenses_client_id);
        $request->validate([
            'right_diopter'=>'required',
            'right_diopter2'=>'required',
            'right_axis'=>'required',
            'left_diopter'=>'required',
            'left_diopter2'=>'required',
            'left_axis'=>'required',
            'all_contact_lenses'=>'required'
        ]);
        $change_contact_lenses_exam->right_eye_sphere = $request->right_diopter;
        $change_contact_lenses_exam->right_eye_cylinder = $request->right_diopter2;
        $change_contact_lenses_exam->right_eye_axis = $request->right_axis;
        $change_contact_lenses_exam->left_eye_sphere = $request->left_diopter;
        $change_contact_lenses_exam->left_eye_cylinder = $request->left_diopter2;
        $change_contact_lenses_exam->left_eye_axis = $request->left_axis;
        $change_contact_lenses_exam->producer = $change_contact_lenses->producer;
        $change_contact_lenses_exam->type = $change_contact_lenses->type;
        $change_contact_lenses_exam->base_curve = $change_contact_lenses->base_curve;
        $change_contact_lenses_exam->diameter = $change_contact_lenses->diameter;
        $change_contact_lenses_exam->material = $change_contact_lenses->material;
        $change_contact_lenses_exam->packaging = $change_contact_lenses->packaging;
        $change_contact_lenses_exam->maximum_use = $change_contact_lenses->maximum_use;
        if ($request->green){
            $change_contact_lenses_exam->exam = $request->green;
        }else{
            $change_contact_lenses_exam->exam = $request->red;
        }
        $change_contact_lenses_exam->contact_lenses_client_id = $single_client->id;
        $change_contact_lenses_exam->update();

        return redirect()->back()->with('message','Podaci su promenjeni');

    }

    public function saveProximityForm(Request $request,$id)
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
            'left_eye_pd'=>'required',
            'note'=>'nullable|string|max:100'
        ]);

        $new_examination = new Proximity();
        $new_examination->right_eye_sphere = $request->right_diopter;
        $new_examination->right_eye_cylinder = $request->right_diopter2;
        $new_examination->right_eye_axis = $request->right_axis;
        $new_examination->right_eye_pd = $request->right_eye_pd;
        $new_examination->left_eye_sphere = $request->left_diopter;
        $new_examination->left_eye_cylinder = $request->left_diopter2;
        $new_examination->left_eye_axis = $request->left_axis;
        $new_examination->left_eye_pd = $request->left_eye_pd;
        $new_examination->note = $request->note;
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

        return redirect()->back()->with('message1','New data sent');
    }

    public function showStock()
    {
        $all_stocks = Stock::all();
        $total = Stock::all()->reduce(function ($total, $item) {  // dobijam zbirno stanje na lageru od proizvoda dve kolone
            return $total + ($item->selling_price * $item->quantity);
        });
        $cl_sum = Stock::where('item_type', 'KS')->sum('quantity');
        $glasses_sum = Stock::where('item_type', 'Ram')->sum('quantity');
        return view('stock', compact('all_stocks', 'total', 'cl_sum', 'glasses_sum'));
    }





}
