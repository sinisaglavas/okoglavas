<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Debt_company;
use App\Models\Client;
use App\Models\Company_debtor;
use Illuminate\Support\Facades\Session;


class CompanyDebtorController extends Controller
{
    public function showDebtCompanyForm() {
        $all_clients = Client::all();
        $debt_companies = Debt_company::all();

        return view('showDebtCompanyForm', compact('all_clients', 'debt_companies'));
    }

    public function saveNewClientCompany(Request $request) {
        $request->validate([
            'client'=>'required',
            'debit'=>'required',
            'installment_number'=>'required',
            'installment_amount'=>'required',
            'debt_companies'=>'required',
        ]);
        if ($request->note != null)
            $request->validate([
                'note'=>'required|string|max:150'
            ]);

        $client_name = Client::find($request->client);
        $company_name = Debt_company::find($request->debt_companies);
        $debt_company = new Company_debtor();
        $debt_company->name = $client_name->name;
        $debt_company->debit = $request->debit;
        $debt_company->installment_number = $request->installment_number;
        $debt_company->installment_amount = $request->installment_amount;
        $debt_company->debt_company	 = $company_name->name_company;
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
        $clients_organisations = Company_debtor::all();

        return view('viewClientsOrganisations', compact('clients_organisations'));
    }


}
