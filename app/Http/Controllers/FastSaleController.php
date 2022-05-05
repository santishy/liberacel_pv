<?php

namespace App\Http\Controllers;

use App\Events\CommissionSale;
use App\Http\Requests\StoreFastSaleRequest;
use App\Http\Resources\FastSaleCollection;
use App\Http\Resources\FastSaleResource;
use App\Http\Responses\ReportResponse;
use App\Models\FastSale;
use App\Models\ProductBonuses;
use Illuminate\Http\Request;

class FastSaleController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('viewAny', new FastSale);
        if ($request->wantsJson()) {
            return new  ReportResponse(FastSale::query());
        }

        return view('fast-sales.index');
    }
    public function store(StoreFastSaleRequest $request)
    {
        $this->authorize('create', new FastSale); 

        $fastSale = FastSale::findOrCreateFastSale();

        $fastSale->addConcept();

        if(filled($request->product_bonus_id)){
            
        }

        $fastSaleFresh = $fastSale->fresh();
        
        return FastSaleResource::make($fastSaleFresh);
    }

    public function create()
    {
        $this->authorize('create', new FastSale);
        $productBonuses = ProductBonuses::all();
        $sale = session()->has('fast-sale') ? fastSale::find(session('fast-sale')) : new FastSale;
        $sale = FastSaleResource::make($sale);
        return view('fast-sales.create', compact('sale','productBonuses'));
    }

    public function update(Request $request, FastSale $sale)
    {
        $this->authorize('update', new FastSale);
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

    public function destroy(Request $request, FastSale $sale)
    {
        $this->authorize('delete', new FastSale);
        $sale->applyRemovals();
        return FastSaleResource::make($sale->fresh());
    }
}
