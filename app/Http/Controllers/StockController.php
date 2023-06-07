<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;
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
            'quantity'=>'required',
            'selling_price'=>'required'
            ]);
        $new_stock = new Stock();
        $new_stock->article = $request->article;
        $new_stock->item_type = $request->item_type;
        $new_stock->describe = $request->describe;
        $new_stock->material = $request->material;
        $new_stock->installation_type = $request->installation_type;
        $new_stock->purchase_price = $request->purchase_price;
        $new_stock->selling_price = $request->selling_price;
        $new_stock->quantity = $request->quantity;
        $new_stock->save();
        return redirect()->back()->with('message','Novi artikal je snimljen');

    }

    public function searchStock()
    {
        $all_stocks = Stock::all();

        $total = $total = Stock::all()->reduce(function ($total, $item) {  // dobijam ukupno stanje na lageru od dve kolone
            return $total + ($item->selling_price * $item->quantity);
        });

        $request = request()->article;

        $article_exists = Stock::where('article','like','%'.$request.'%')->exists();
        $selling_price_exists = Stock::where('selling_price','like','%'.$request.'%')->exists();
        $material_exists = Stock::where('material','like','%'.$request.'%')->exists();
        $describe_exists = Stock::where('describe','like','%'.$request.'%')->exists();

        $cl_sum = Stock::where('item_type', 'KS')->sum('quantity');
        $glasses_sum = Stock::where('item_type', 'Ram')->sum('quantity');
        $sunglasses_sum = Stock::where('item_type', 'Sunčane')->sum('quantity');
        $dl_sum = Stock::where('item_type', 'DS')->sum('quantity');

        if ($article_exists && $request != "")
        {
            $search_stocks = Stock::where('article','like','%'.$request.'%')->get();//carobna linija koda
            return view('stock', compact('search_stocks', 'all_stocks', 'total', 'cl_sum', 'glasses_sum', 'sunglasses_sum', 'dl_sum'));
        }
        elseif ($selling_price_exists && $request != "")
        {
            $search_stocks = Stock::where('selling_price','like','%'.$request.'%')->get();//carobna linija koda
            return view('stock', compact('search_stocks', 'all_stocks', 'total', 'cl_sum', 'glasses_sum', 'sunglasses_sum', 'dl_sum'));
        }elseif ($describe_exists && $request != "")
        {
            $search_stocks = Stock::where('describe','like','%'.$request.'%')->get();
            return view('stock', compact('search_stocks', 'all_stocks', 'total', 'cl_sum', 'glasses_sum', 'sunglasses_sum', 'dl_sum'));
        }elseif ($request == "")
        {
            return view('stock', compact('all_stocks', 'total', 'cl_sum', 'glasses_sum', 'sunglasses_sum', 'dl_sum'));
        }
        elseif ($article_exists == false || $selling_price_exists == false || $material_exists == false){
            return view('stock', compact('all_stocks', 'total', 'cl_sum', 'glasses_sum', 'sunglasses_sum', 'dl_sum'));
        }

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
        $stock->material = $request->material;
        $stock->installation_type = $request->installation_type;
        $stock->purchase_price = $request->purchase_price;
        $stock->selling_price = $request->selling_price;
        $stock->quantity = $request->quantity;
        $stock->update();

        return redirect()->back()->with('message','Artikal je izmenjen');
    }


}
