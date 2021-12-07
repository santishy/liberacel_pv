<?php

namespace App\Http\Controllers;

use App\Models\FastSale;
use Illuminate\Http\Request;

class FastSaleController extends Controller
{
    public function store(Request $request)
    {
        
        $data = $request->validate([
            'description' => 'required',
            'price' => 'required|numeric|min:1',
            'qty' => 'required|integer'
        ]);

        $fastSale = FastSale::findOrCreateFastSale();

        $fastSale->total += $data['price'] * $data['qty']; 
        $fastSale->concepts = $data;

        $fastSale->save();

        return response()->json([
            'product' => $data,
            'id' => $fastSale->id,
            'total' => $fastSale,
            'status' => $fastSale->status
        ]);
    }

    public function create(){
        $sale = fastSale::find(session()->get('fast-sale'));
        return view('fast-sales.create',compact('sale'));
    }

    public function update(Request $request,FastSale $sale){
        $data = $request->validate([
            'description' => 'required',
            'price' => 'required|numeric|min:1',
            'qty' => 'required|integer|min:1',
            'index' => 'required'
        ]);
        
      
        dd($sale->concepts[$data['index']]);
            
        dd($sale->concepts);
        $sale->save();

        return $sale;


    }
}
