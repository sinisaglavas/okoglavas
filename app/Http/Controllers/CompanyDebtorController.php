<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Debt_company;
use App\Models\Client;
use App\Models\Company_debtor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class CompanyDebtorController extends Controller
{
    public function showDebtCompanyForm() { // imena iz dve tabele poredjana po abecednom redu
        $all_clients = DB::table('clients')
            ->select('id', 'name')
            ->union(DB::table('contact_lenses_clients')->select('id', 'name'))->orderBy('name')->get();
        $debt_companies = Debt_company::all();

        return view('showDebtCompanyForm', compact('all_clients', 'debt_companies'));
    }

    public function saveNewClientCompany(Request $request) {
        $request->validate([
            'date'=>'required|date',
            'client'=>'required',
            'debit'=>'required',
            'installment_number'=>'required',
            'installment_amount'=>'required',
            'debt_companies'=>'required',
        ]);
        if ($request->note != null)
            $request->validate([
                'note'=>'required|string|max:60'
            ]);

        $client_name = Client::find($request->client);
        $company_name = Debt_company::find($request->debt_companies);
        $last_total_all = Company_debtor::count() > 0 ? Company_debtor::latest('created_at')->value('total_all') : 0;

        $debt_company = new Company_debtor();
        $debt_company->date = $request->date;
        $debt_company->debt_company	 = $company_name->name_company;
        $debt_company->name = $client_name->name;
        $debt_company->debit = $request->debit;
        $debt_company->installment_number = $request->installment_number;
        $debt_company->installment_amount = $request->installment_amount;
        $debt_company->total_all = $last_total_all + $request->debit;

        if ($request->note != null){
            $debt_company->note = $request->note;
        } else {
            $debt_company->note = '';
        }
        $debt_company->debt_company_id = $request->debt_companies;
        $debt_company->client_id = $request->client;
        $debt_company->save();

        Session::flash('message','Podaci su poslati!');
        return redirect()->back();
    }

    public function viewClientsOrganisations() {
        $clients_organisations = Company_debtor::orderBy('id', 'asc')->get(); // Sve klijente poredjaj po id-u u rastucem redosledu
        // Koristimo map metod za prolazak kroz svaki element niza da bih kreirao datum (date) u odgovarajucem formatu
        $clients_organisations = $clients_organisations->map(function ($client) {
            // Ako 'date' postoji i nije null, formatiraj ga koristeći Carbon
            if ($client->date) {
                $client->formatted_date = Carbon::parse($client->date)->format('d.m.Y'); // formatted_date je kreirano sada
            } else {
                // Ako 'date' ne postoji ili je null, postavi formatted_date na null ili željenu vrednost po potrebi
                $client->formatted_date = null; // ili postavite neku drugu vrednost
            }

            return $client; // Vrati element niza, da bi moglo da se doda u novi niz
        });

        return view('viewClientsOrganisations', compact('clients_organisations'));
    }

    public function deleteClientOrganisation($id) {
        $client_organisation = Company_debtor::find($id);
        $client_organisation->delete();

        $all_debit = Company_debtor::sum('debit');
        $lastClient = Company_debtor::latest()->first();
        $lastClient->total_all = $all_debit;
        $lastClient->update();
        $clients_organisations = Company_debtor::orderBy('id', 'asc')->get(); // Sve klijente poredjaj po id-u u rastucem redosledu

        return view('viewClientsOrganisations', compact('clients_organisations'));
    }


}
