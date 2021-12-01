<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateStoreWarehouse;
use App\Http\Resources\InventoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class InventoryController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', new Inventory);
        if (request()->wantsJson()) {
            return response()->json([
                'data' => Inventory::all()
            ]);
        }
        return view('inventories.index', ['inventories' => Inventory::all()]);
    }
    public function create()
    {
        $this->authorize('create', new Inventory);
        return view('inventories.create');
    }

    public function store(UpdateStoreWarehouse $request)
    {
        $this->authorize('create', new Inventory);
        return Inventory::create($request->only('name','address'));
    }

    public function edit(Inventory $inventory, Request $request)
    {
    }
    /**
     * Update the stock of a product
     */
    public function update(Inventory $inventory, Request $request)
    {
        Gate::authorize('edit-stock',$inventory);
        request()->validate([
            'product_id' => ['required', 'exists:products,id'],
            'stock' => ['min:0', 'required', 'numeric']
        ], [
            'stock.required' => 'Las existencias son requiredas.',
            'stock.min' => 'Las existencias deben ser al menos cero',
            'stock.numeric' => 'El tipo de dato debe ser númerico'
        ]);

        $updated = $inventory->updateStock(request('product_id'), request('stock'));

        return response()->json([
            'newStock' => request('stock')
        ]);
    }

    /**
     * Empty stocks
     */
    public function destroy(Inventory $inventory)
    {
        Gate::authorize('empty-stock',$inventory);
        return response()->json(['empty' => $inventory->epmtyStock()]);
    }

    public function show(Inventory $inventory)
    {
        Gate::authorize('view-stock',$inventory);
        return ProductResource::collection(
            $inventory->products()->applyFilters()->paginate(25)
        );
    }
}
