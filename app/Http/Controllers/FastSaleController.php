<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreFastSaleRequest;
use App\Http\Requests\UpdateFastSaleRequest;
use App\Http\Resources\FastSaleCollection;
use App\Http\Resources\FastSaleResource;
use App\Http\Responses\ReportResponse;
use App\Models\FastSale;
use App\Models\ProductBonus;
use App\Models\Setting;
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

    public function create()
    {
        $this->authorize('create', new FastSale);

        $pointData = Setting::where('name', 'precio_punto')->first();

        $productBonuses = ProductBonus::all();
        //$sale = session()->has('fast-sale') ? fastSale::find(session('fast-sale')) : null;
        $sale = optional(fastSale::find(session('fast-sale')))->load('customerBonus', 'productBonuses');

        if (isset($sale)) {
            $sale = FastSaleResource::make($sale);
        }

        return view('fast-sales.create', compact('sale', 'productBonuses'));
    }

    public function store(StoreFastSaleRequest $request)
    {
        $this->authorize('create', new FastSale);

        $fastSale = FastSale::findOrCreateFastSale();

        $fastSale->addConcept();

        $fastSale->addBonus();

        if (
            $request->is_credit &&
            $request->client_id &&
            $fastSale->client_id === null
        ) {

            $fastSale->update(
                $request->only(['is_credit', 'client_id'])
            );
        }
        $fastSaleFresh = $fastSale->fresh();

        return FastSaleResource::make($fastSaleFresh->load('productBonuses', 'customerBonus'));
    }

    public function update(UpdateFastSaleRequest $request, FastSale $sale)
    {
        $this->authorize('update', new FastSale);

        $data = $request->all();

        $sale["concepts->$data[index]"] = collect($data)
            ->except('index');

        $sale->total = $sale->calculateTotal();

        $sale->save();

        $sale->productBonuses()
            ->updateExistingPivot($request->product_bonus_id, [
                'qty' => $request->qty,
            ]);

        return FastSaleResource::make(
            $sale->fresh()->load('productBonuses', 'customerBonus')
        );
    }

    public function destroy(Request $request, FastSale $sale)
    {

        $this->authorize('delete', new FastSale);

        $sale->applyRemovals();

        return FastSaleResource::make($sale->fresh()->load('productBonuses', 'customerBonus'));
    }
}
