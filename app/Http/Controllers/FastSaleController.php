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
            'products' => $fastSale->products,
            'id' => $fastSale->id,
            'total' => $fastSale,
            'status' => $fastSale->status
        ]);
    }

    public function create(){
        return view('fast-sales.create');
    }
}
