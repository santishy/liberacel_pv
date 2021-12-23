<?php

namespace App\Http\Controllers;

use App\Http\Resources\FastSaleResource;
use App\Models\FastSale;
use Illuminate\Http\Request;

class FastSaleController extends Controller
{
    public function index(Request $request){
        if($request->wantsJson()){
            return  FastSale::include()->applyFilters()->paginate(50);
        }
        
        return view('fast-sales.index');
    }
    public function store(Request $request)
    {
        
        $data = $request->validate([
            'description' => 'required',
            'price' => 'required|numeric|min:1',
            'qty' => 'required|integer'
        ]);

        $fastSale = FastSale::findOrCreateFastSale();
        
        $fastSale->total += $data['price'] * $data['qty']; 
        $fastSale['concepts'] = $data;
        $fastSale->save();
        return FastSaleResource::make($fastSale->fresh());
    }

    public function create(){
        $sale = session()->has('fast-sale') ? fastSale::find(session('fast-sale')) : new FastSale;
        $sale = FastSaleResource::make($sale);
        return view('fast-sales.create',compact('sale'));
    }

    public function update(Request $request,FastSale $sale){
        $data = $request->validate([
            'description' => 'required',
            'price' => 'required|numeric|min:1',
            'qty' => 'required|integer|min:1',
            'index' => 'required'
        ]);
        
        $sale["concepts->$data[index]"] = collect($data)->except('index');

        $sale->total = $sale->calculateTotal();

        $sale->save();

        return FastSaleResource::make($sale->fresh());

    }

    public function destroy(Request $request,FastSale $sale){
        
        $sale->applyRemovals();
        return FastSaleResource::make($sale->fresh());
    }
}
