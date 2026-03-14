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
            'iventory_id' => 'exists:inventories,id|required',
        ], [
            'inventory_id.required' => 'El inventario es requerido.',
            'inventory_id.exists' => 'El inventario no existe en la base de datos.',
        ]);
        session('inventory_id')->put($request->inventory_id);

        return redirect()->intented('/');
    }
}
