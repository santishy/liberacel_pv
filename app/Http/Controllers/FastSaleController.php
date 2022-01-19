<?php

namespace App\Http\Controllers;

use App\Http\Resources\FastSaleCollection;
use App\Http\Resources\FastSaleResource;
use App\Http\Responses\ReportResponse;
use App\Models\FastSale;
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
    public function store(Request $request)
    {
        $this->authorize('create', new FastSale);
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

    public function create()
    {
        $this->authorize('create', new FastSale);
        $sale = session()->has('fast-sale') ? fastSale::find(session('fast-sale')) : new FastSale;
        $sale = FastSaleResource::make($sale);
        return view('fast-sales.create', compact('sale'));
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
