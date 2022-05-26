<?php

namespace App\Http\Controllers;

use App\Events\FastSaleUpdated;
use App\Models\FastSale;
use Illuminate\Http\Request;

class FastSaleAssociatedUserController extends Controller
{
    public function store(Request $request, FastSale $fastSale)
    {
        $this->authorize('restore', $fastSale);

        $associatedUser  = $fastSale->checkCredentials(
            $request->username,
            $request->password
        );
    
        $fastSale->toggleUser($associatedUser);

        FastSaleUpdated::dispatch($fastSale);

        return response()->json([
            'sale' => $fastSale
        ]);
    }
}
