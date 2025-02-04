<?php

namespace App\Http\Controllers;

use App\Models\Daily_turnover;
use App\Models\Stock;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DailyTurnoverController extends Controller
{
    public function index()
    {
        return view('sdt');
    }


    public function showDailyTurnover()  // JS
    {
        $daily_turnover = Daily_turnover::all();

        return $daily_turnover;
    }


    public function saveDailyTurnover(Request $request)
    {
        $request->validate([
            'article' => 'required',
            'pcs' => 'required',
            'total' => 'required'
        ]);

        $search_data = Daily_turnover::where('created_at', $request->search_date)->get();
        $search_date = $request->search_date;
        $daily_turnover = new Daily_turnover();
        $daily_turnover->article = $request->article;
        $daily_turnover->describe = $request->describe;
        $daily_turnover->material = $request->material;
        $daily_turnover->installation_type = $request->installation_type;
        $daily_turnover->pcs = $request->pcs;
        $daily_turnover->price = $request->price;
        $daily_turnover->discount = $request->discount;
        $daily_turnover->total = $request->total;
        if (isset($request->client_id)) {
            $daily_turnover->client_id = $request->client_id; }
        $daily_turnover->stock_id = $request->article_id;
        $daily_turnover->user_id = auth()->user()->id;
        $daily_turnover->created_at = $search_date;
        $daily_turnover->save();

        $id = $request->article_id;
        $pcs = $request->pcs;
        $update = Stock::find($id);
        $update->quantity = $update->quantity - $pcs;
        $update->update();

        $sum = DB::table('daily_turnovers')->where('created_at', $request->search_date)->select('total')->sum('total');

        return redirect()->route('requestedDay', ['date' => $search_date, 'client_id'=>$request->client_id]);


    }

    /*
     * Skidanje artikla sa stanja i brisanje tog artikla sa lagera
     * update article je artikal u lageru kome povecavamo stanje tj. vracamo na stanje
     * delete_article je artikal u dnevnom prometu koji brisemo i vracamo na stanje
     */
    public function updateBeforeDelete(Request $request, $id, $stock_id, $search_date, $sum)
    {
        $clientId = $request->query('client_id'); // Ili $request->input('client_id')
        $update_article = Stock::find($stock_id);
        $delete_article = Daily_turnover::find($id);

        $update_article->quantity += $delete_article->pcs;
        $update_article->update();
        $delete_article->delete();
        if ($request->client_id) { //uslov u cilju vracanja stranice sa istim url-om
            $client_id = $request->query('client_id'); // Ili $request->input('client_id')
            return redirect()->route('requestedDay', ['date' => $search_date, 'client_id'=>$client_id]);
        }else {
            return redirect()->route('requestedDay', ['date' => $search_date]);
        }
    }

    public function requestedDay(Request $request)
    {
        $search_date = $request->date;
        $search_data = Daily_turnover::where('created_at', $search_date)->get();
        $sum = DB::table('daily_turnovers')->where('created_at', $search_date)
            ->select('total')->sum('total'); // dobijamo ukupan promet na trazeni dan
        if(isset($request->client_id))
        {
            $client_id = $request->client_id; // naknadno dodato zbog pracenja kupca po kupljenoj robi 31.01.2025.

            return view('requestedDay', compact('search_data', 'search_date', 'sum', 'client_id'));
        }else {
            return view('requestedDay', compact('search_data', 'search_date', 'sum'));
        }
    }

    public function viewMonthlyTurnover($id)
    {
        $turnover_by_days = DB::table('daily_turnovers')
            ->select('created_at', DB::raw('SUM(total) as sum'))
            ->groupBy('created_at')
            ->get(); // iz dokumentacije laravel-a - ukupan promet po datumima zajedno grupisano



        $monthly_turnovers = Daily_turnover::select(DB::raw('DATE(created_at) as day'), DB::raw('SUM(total) as sum'))
            ->whereMonth('created_at', $id)
            ->groupBy('day')
            ->orderBy('day')
            ->get(); // dobijamo kolekciju ukupnih prometa za sve dane trazenog meseca

        return view('turnoverByDays', compact('monthly_turnovers', 'turnover_by_days'));

    }

    public function dateRange(Request $request)
    {

        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        // Upit za dohvatanje podataka o prometu za odabrani raspon datuma
        // $total_turnover sada sadrži ukupan promet za odabrani raspon datuma
        $total_turnover = DB::table('daily_turnovers')
            ->whereBetween('created_at', [$start_date, $end_date])
            ->sum('total');

        $start_date = Carbon::parse($start_date);
        $start_date = $start_date->format('d.m.Y.');
        $end_date = Carbon::parse($end_date);
        $end_date = $end_date->format('d.m.Y.');

        $turnover_by_days = DB::table('daily_turnovers')
            ->select('created_at', DB::raw('SUM(total) as sum'))
            ->groupBy('created_at')
            ->get(); // iz dokumentacije laravel-a - ukupan promet po datumima zajedno grupisano

        return view('turnoverByDays', compact('turnover_by_days', 'start_date', 'end_date', 'total_turnover'));

    }

    public function getClientPurchases($client_id)
    {
        $purchases = Daily_turnover::where('client_id', $client_id)->get();
        return response()->json($purchases);
    }



}
