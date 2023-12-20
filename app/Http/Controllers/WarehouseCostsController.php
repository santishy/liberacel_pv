<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class WarehouseCostsController extends Controller
{
    public function index(Inventory $inventory)
    {
        return response()->json(
            [
                "total_cost" => "$" . number_format($inventory->getTotalCostOfProductsInStock(), 2)
            ]
        );
    }
}
