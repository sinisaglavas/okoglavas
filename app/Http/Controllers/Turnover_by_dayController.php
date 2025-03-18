<?php

namespace App\Http\Controllers;

use App\Models\Daily_turnover;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Turnover_by_dayController extends Controller
{
    public function index(){
        $turnover_by_days = DB::table('daily_turnovers')
            ->select('created_at', DB::raw('SUM(total) as sum'))
            ->groupBy('created_at')
            ->get(); // iz dokumentacije laravel-a - ukupan promet po datumima zajedno grupisano

        return view('turnoverByDays', compact('turnover_by_days'));
    }
    public function totalPerDay()  // JS
    {
        $total_per_day = DB::table('daily_turnovers')
            ->select('date_of_sale', DB::raw('SUM(total) as sum'))
            ->groupBy('date_of_sale')
            ->get();

        return $total_per_day;
    }

    public function displayTurnover($search_date)
    {
        $search_data = Daily_turnover::where('created_at', $search_date)->orderBy('id', 'ASC')->get();
        $sum = DB::table('daily_turnovers')->where('created_at', $search_date)
            ->select('total')->sum('total');

        session()->put('from_method', 'displayTurnover');
        //koristimo za uslov u requestedDay - umesto flash() koristimo put() tako da podaci ostanu u sesiji dok se ručno ne obrišu

        return view('requestedDay', compact('search_data', 'search_date', 'sum'));

    }

}


