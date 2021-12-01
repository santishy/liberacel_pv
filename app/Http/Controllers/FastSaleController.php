<?php

namespace App\Http\Controllers;

use App\Models\FastSale;
use Illuminate\Http\Request;

class FastSaleController extends Controller
{
    public function store(Request $request){
        $data = $request->validate([
            'description' => 'required',
            'price' => 'required|numeric|min:1',
            'qty' => 'required|integer'
        ]);

        $fastSale = FastSale::findOrCreateFastSale();
        $fastSale->concepts = json_encode($data);
        $fastSale->save();
        return $fastSale;

    }
}
