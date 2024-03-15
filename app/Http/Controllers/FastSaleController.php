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
use Illuminate\Validation\ValidationException;

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
        $sale = optional(fastSale::find(session('fast-sale')))->load('customerBonus', 'productBonuses');

        if (isset($sale)) {
            if ($sale->status != "pending") {
                session()->forget("sale-id");
                $sale = null;
            } elseif ($sale->status === "pending") {
                $sale = FastSaleResource::make($sale);
            }
        }
        return view('fast-sales.create', compact('sale', 'productBonuses'));
    }

    public function store(StoreFastSaleRequest $request)
    {
        $this->authorize('create', new FastSale);

        $fastSale = $this->isTheStatusCompleted(FastSale::findOrCreateFastSale());

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
    private function clearFastSaleSessionIfNotPending($fastSale)
    {
        if ($fastSale->status != "pending") {
            session()->forget('fast-sale');
        }
    }
    private function isTheStatusCompleted($fastSale)
    {
        if ($fastSale->status === "completed") {
            session()->forget("fast-sale");
            return FastSale::findOrCreateFastSale();
        }
        return $fastSale;
    }

    public function update(UpdateFastSaleRequest $request, FastSale $sale)
    {
        $this->authorize('update', new FastSale);

        $data = $request->all();


        if ($request->has('index')) {

            $sale["concepts->$data[index]"] = collect($data)
                ->except(['index']);
            $sale->total = $sale->calculateTotal();
        }

        if ($request->has('is_credit')) {
            if ($sale->client_id === null && $request->is_credit) {
                throw
                throw ValidationException::withMessages([
                    'client_id' => 'El cliente es requerido para realizar una venta a crédito'
                ]);
            }
            $sale->is_credit = $request->is_credit;
        }

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
