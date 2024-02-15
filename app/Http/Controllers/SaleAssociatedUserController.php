<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class SaleAssociatedUserController extends Controller
{
    public function store(Request $request, Sale $sale)
    {
        //$this->authorize('restore', $sale);

        $associatedUser  = $sale->checkCredentials(
            $request->username,
            $request->password
        );
        $sale->toggleUser($associatedUser);

        return response()->json([
            'sale' => $sale
        ]);
    }
}
