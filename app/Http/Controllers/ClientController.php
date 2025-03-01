<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Contact_lense;
use App\Models\Contact_lenses_client;
use App\Models\Contact_lenses_exam;
use App\Models\Diopter;
use App\Models\Dist_pupillary;
use App\Models\Distance;
use App\Models\Proximity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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

    public function editProximityForm($proximity_id)
    {
        $single_proximity = Proximity::find($proximity_id);
        $single_client = Client::find($single_proximity->client_id);
        $all_diopters = Diopter::all();
        $all_pd = Dist_pupillary::all();

        return view('editClientExamination', compact('single_proximity','single_client', 'all_diopters', 'all_pd'));
    }

    public function editContactLensesExam($contact_lenses_exam_id)
    {
        $contact_lenses_exam = Contact_lenses_exam::find($contact_lenses_exam_id);
        $single_client = Contact_lenses_client::find($contact_lenses_exam->contact_lenses_client_id);
        $all_diopters = Diopter::all();
        $all_contact_lenses = Contact_lense::all();

        return view('editContactLensesExam', compact('single_client', 'contact_lenses_exam', 'all_diopters', 'all_contact_lenses'));
    }

    public function clientsShow($id)
    {
        $client = Client::with('glasses')->findOrFail($id);  // Učitaj klijenta i naočare koje je kupio-aко клијент са тим ID-јем не постоји, баца 404 грешку (findOrFail).

        return redirect()->back()->with('client', $client);

        //return view('requestedDay', compact('client'));
    }


    function sendViberMessage($receiverId, $message) {
        $apiToken = env('VIBER_API_TOKEN'); // Smesti token u .env fajl
        $url = 'https://chatapi.viber.com/pa/send_message';

        $payload = [
            'receiver' => $receiverId,
            'min_api_version' => 1,
            'sender' => [
                'name' => 'NazivBota',
                'avatar' => 'URL_do_avatar_slike'
            ],
            'type' => 'text',
            'text' => $message,
        ];

        $response = Http::withHeaders([
            'X-Viber-Auth-Token' => $apiToken,
        ])->post($url, $payload);

        return $response->json();
    }




}
