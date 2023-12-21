<?php

namespace App\Http\Controllers;

use App\Events\FastSaleUpdated;
use App\Events\SaleTransactionProcessed;
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
        SaleTransactionProcessed::dispatch($fastSale);

        // if ($request->is_credit && $request->client_id) {
        //     $inverse = -1;
        //     $fastSale->update(
        //         $request->only(['is_credit', 'client_id'])
        //     );
        //     $fastSale->handleCredit($this->factors[$fastSale->status] * $inverse);
        // }

        return response()->json([
            'sale' => $fastSale
        ]);
    }
}
