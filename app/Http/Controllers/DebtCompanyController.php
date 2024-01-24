<?php

namespace App\Http\Controllers;

use App\Models\Debt_company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Company_debtor;
use Illuminate\Support\Facades\Session;

class DebtCompanyController extends Controller
{
    public function viewAllCompany() {
        $companies = Debt_company::all();

        return view('viewAllCompanies', compact('companies'));
    }

    public function saveNewCompany(Request $request) {
        $request->validate([
            'name_company'=>'required',
        ]);
        if ($request->other_data != null)
            $request->validate([
                'other_data'=>'required|string|max:150'
            ]);

        $companies = Debt_company::all();
        $debt_companies = new Debt_company();
        $debt_companies->name_company = $request->name_company;
        if ($request->other_data != null){
            $debt_companies->other_data = $request->other_data;
        } else {
            $debt_companies->other_data = '';
        }
        $debt_companies->save();

        Session::flash('message','Podaci su poslati!');
        //$companies = session('companies');
        return redirect()->back()->with('companies', $companies); // TODO: check if this is correct

    }


}
