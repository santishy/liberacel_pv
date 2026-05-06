<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryContextController extends Controller
{
    public function show()
    {
        $inventories = Inventory::all();

        return view('inventories.select', compact('inventories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'inventory_id' => 'exists:inventories,id|required',
        ]);
        $request->session()->put('inventory_id', $request->inventory_id);

        return response()->json(['message' => 'Inventory selected successfully']);
    }
}
