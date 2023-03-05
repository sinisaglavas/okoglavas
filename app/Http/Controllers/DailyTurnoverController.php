<?php

namespace App\Http\Controllers;

use App\Models\Daily_turnover;
use App\Models\Stock;
use App\Models\Turnover_by_day;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Psy\Util\Json;

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
                'article'=>'required',
                'pcs'=>'required',
                'total'=>'required'
            ]);

            $search_data = Daily_turnover::where('created_at', $request->search_date)->get();
            $search_date = $request->search_date;
            $daily_turnover = new Daily_turnover();
         //   if ($search_data) {
                $daily_turnover->article = $request->article;
                $daily_turnover->describe = $request->describe;
                $daily_turnover->material = $request->material;
                $daily_turnover->installation_type = $request->installation_type;
                $daily_turnover->pcs = $request->pcs;
                $daily_turnover->price = $request->price;
                $daily_turnover->total = $request->total;
                $daily_turnover->stock_id = $request->article_id;
                $daily_turnover->user_id = auth()->user()->id;
                $daily_turnover->created_at = $search_date;
                $daily_turnover->save();
         //   } else {
//                $daily_turnover->article = $request->article;
//                $daily_turnover->describe = $request->describe;
//                $daily_turnover->material = $request->material;
//                $daily_turnover->installation_type = $request->installation_type;
//                $daily_turnover->pcs = $request->pcs;
//                $daily_turnover->price = $request->price;
//                $daily_turnover->total = $request->total;
//                $daily_turnover->stock_id = $request->article_id;
//                $daily_turnover->user_id = auth()->user()->id;
//                $daily_turnover->save();
//            }

            $id = $request->article_id;
            $pcs = $request->pcs;
            $update = Stock::find($id);
            $update->quantity = $update->quantity - $pcs;
            $update->update();

            $sum = DB::table('daily_turnovers')->where('created_at', $request->search_date)->select('total')->sum('total');

           // return view('requestedDay', compact('search_date', 'search_data', 'sum'));

           // return redirect()->back()->with('message', 'Podaci su uspesno snimljeni');

             return redirect()->route('requestedDay', ['date'=>$search_date]);



        }

        /*
         * Skidanje artikla sa stanja i brisanje tog artikla sa lagera
         * update article je artikal u lageru kome povecavamo stanje tj. vracamo na stanje
         * delete_article je artikal u dnevnom prometu koji brisemo i vracamo na stanje
         */
    public function updateBeforeDelete($id, $stock_id, $search_date, $sum) {
        $update_article = Stock::find($stock_id);
        $delete_article = Daily_turnover::find($id);

        $update_article->quantity += $delete_article->pcs;
        $update_article->update();

       // $search_data = Daily_turnover::where('created_at', $delete_article->created_at)->get();

        $delete_article->delete();
        //$delete_article->status = 'storno'; // status je kolona u tabeli
        //return view('requestedDay', compact('search_data', 'search_date', 'sum'));
        return redirect()->route('requestedDay', ['date'=>$search_date]);
        //return redirect()->back()->with('message', 'Artikal je obrisan iz prometa i vracen ponovo na stanje lagera');
    }

    public function requestedDay(Request $request) {
        $search_date = $request->date;
        $search_data = Daily_turnover::where('created_at', $search_date)->get();
        $sum = DB::table('daily_turnovers')->where('created_at', $search_date)
            ->select('total')->sum('total'); // dobijamo ukupan promet na trazeni dan

        return view('requestedDay', compact('search_data', 'search_date', 'sum'));

    }



}
