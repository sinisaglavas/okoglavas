<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{

    public function showStockForm()
    {
        return view('showStockForm');
    }

    public function saveStock(Request $request)
    {
        $request->validate([
            'article'=>'required',
            'item_type'=>'required',
            'barcode' => ['nullable', 'digits_between:8,15'], ['barcode.digits_between' => 'Bar kod mora imati između 8 i 15 cifara.'],
            'quantity'=>'required',
            'selling_price'=>'required'
            ]);
        $new_stock = new Stock();
        $new_stock->article = $request->article;
        $new_stock->item_type = $request->item_type;
        $new_stock->describe = $request->describe;
        $new_stock->barcode = $request->barcode;
        $new_stock->material = $request->material;
        $new_stock->installation_type = $request->installation_type;
        $new_stock->purchase_price = $request->purchase_price;
        $new_stock->selling_price = $request->selling_price;
        $new_stock->quantity = $request->quantity;
        $new_stock->save();
        return redirect()->back()->with('message','Novi artikal je snimljen');

    }

    public function searchStock(Request $request)
    {
        // Ako je došao POST zahtev, sačuvaj pretragu u sesiji
        if ($request->isMethod('post')) {
            $request->session()->put('search_article', $request->article);
        }

        // Dohvati pretragu iz sesije (ili prazno ako ne postoji)
        $article = session('search_article', '');

        // Ako je pretraga prazna, vraćamo sve artikle
        if (empty($article)) {
            session()->flash('warning', 'Traženi pojam nije pronađen!');
            return $this->returnStockView(Stock::paginate(50));
        }
        // Brža pretraga preko OR WHERE
        $search_stocks = Stock::where('article', 'like', '%' . $article . '%')
            ->orWhere('selling_price', 'like', "%$article%")
            ->orWhere('describe', 'like', "%$article%")->paginate(10);

        if ($search_stocks->isEmpty()) {
            session()->flash('warning', 'Traženi pojam nije pronađen!');
            return $this->returnStockView(Stock::paginate(50));
        }

        return $this->returnStockView($search_stocks);
    }

    // Pomocna metoda za generisanje view-a
    private function returnStockView($stocks)
    {
        $total = Stock::sum(DB::raw('selling_price * quantity')); // Efikasnija kalkulacija ukupne vrednosti
        $cl_sum = Stock::where('item_type', 'KS')->sum('quantity');
        $glasses_sum = Stock::where('item_type', 'Ram')->sum('quantity');
        $sunglasses_sum = Stock::where('item_type', 'Sunčane')->sum('quantity');
        $dl_sum = Stock::where('item_type', 'DS')->sum('quantity');

        return view('stock', compact('stocks', 'total', 'cl_sum', 'glasses_sum', 'sunglasses_sum', 'dl_sum'));
    }

    public function searchStockBarcode(Request $request) // 22.03.2025. dodato - bolje radi kada je razdvojena pretraga
    {
        // Ako je došao POST zahtev, sačuvaj pretragu u sesiji
        if ($request->isMethod('post')) {
            $request->session()->put('search_barcode', $request->barcode);
        }

        // Dohvati pretragu iz sesije (ili prazno ako ne postoji)
        $barcode = session('search_barcode', '');

        if (empty($barcode)) {
            session()->flash('attention', 'Traženi bar kod nije pronađen!');
            return $this->returnStockView(Stock::paginate(50));
        }

        $search_stocks = Stock::where('barcode', $barcode)->paginate(10);

        if ($search_stocks->isEmpty()) {
            session()->flash('attention', 'Traženi bar kod nije pronađen!');
            return $this->returnStockView(Stock::paginate(50));
        }

        return $this->returnStockView($search_stocks);
    }

    public function editStock($id)
    {
        $stock = Stock::find($id);

        return view('editStock', compact('stock'));
    }

    public function updateStock(Request $request, $id)
    {
        $stock = Stock::find($id);
        $request->validate([
            'article'=>'required',
            'item_type'=>'required',
            'quantity'=>'required',
            'selling_price'=>'required'
        ]);
        $stock->article = $request->article;
        $stock->item_type = $request->item_type;
        $stock->describe = $request->describe;
        $stock->barcode = $request->barcode;
        $stock->material = $request->material;
        $stock->installation_type = $request->installation_type;
        $stock->purchase_price = $request->purchase_price;
        $stock->selling_price = $request->selling_price;
        $stock->quantity = $request->quantity;
        $stock->update();

        return redirect()->back()->with('message','Artikal je izmenjen');
    }

    public function checkArticleData(Request $request)
    {
        $articles = $request->input('articles');

        return view('showStockForm', compact('articles'));
    }

    public function stockContactLenses() {
        $contact_lenses = Stock::where('item_type', 'KS')->get();
        $cl_sum = Stock::where('item_type', 'KS')->sum('quantity');
        $total = Stock::where('item_type', 'KS')->get()->sum(function ($item) {
            return $item->selling_price * $item->quantity;
        }); // dobijam ukupnu vrednost svih kontaktnih sočiva
        //dd($total);

        return view('home.stockContactLenses', compact('contact_lenses', 'cl_sum', 'total'));
    }

    public function stockGlasses() {
        $frames = Stock::where('item_type', 'Ram')->get();
        $glasses_sum = Stock::where('item_type', 'Ram')->sum('quantity');
        $total = Stock::where('item_type', 'Ram')->get()->sum(function ($item) {
            return $item->selling_price * $item->quantity;
        }); // dobijam ukupnu vrednost svih naocara
        //dd($total);

        return view('home.stockFrames', compact('frames', 'glasses_sum', 'total'));
    }

    public function stockSunglasses() {
        $sunglassess = Stock::where('item_type', 'Sunčane')->get();
        $sunglasses_sum = Stock::where('item_type', 'Sunčane')->sum('quantity');
        $total = Stock::where('item_type', 'Sunčane')->get()->sum(function ($item) {
            return $item->selling_price * $item->quantity;
        }); // dobijam ukupnu vrednost svih suncanih naocara
        //dd($total);

        return view('home.stockSunglasses', compact('sunglassess', 'sunglasses_sum', 'total'));
    }

    public function stockDioptricLenses() {
        $dioptric_lenses = Stock::where('item_type', 'DS')->get();
        $dl_sum = Stock::where('item_type', 'DS')->sum('quantity');
        $total = Stock::where('item_type', 'DS')->get()->sum(function ($item) {
            return $item->selling_price * $item->quantity;
        }); // dobijam ukupnu vrednost svih dioptrijskih stakala

        return view('home.stockDioptricLenses', compact('dioptric_lenses', 'dl_sum', 'total'));
    }

}
