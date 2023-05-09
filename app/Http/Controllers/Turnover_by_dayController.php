<?php

namespace App\Http\Controllers;

use App\Models\Daily_turnover;
use App\Models\Turnover_by_day;
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

    public function displayTurnover($turnover_by_day) {
        $the_data = Daily_turnover::where('created_at', $turnover_by_day)->get();
        $sum = DB::table('daily_turnovers')->where('created_at', $turnover_by_day)
            ->select('total')->sum('total');

        return view('requestedDay', compact('the_data', 'turnover_by_day', 'sum'));

    }




}


