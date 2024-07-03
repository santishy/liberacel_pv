<?php

namespace App\Http\Controllers;

use App\Http\Resources\CreditNoteResource;
use App\Models\Credit;
use Illuminate\Http\Request;

class CreditNotesController extends Controller
{
    public function index(Credit $credit)
    {

        $sales = CreditNoteResource::collection(
            $credit->sales()->applyFilters()->orderBy('id', 'desc')->paginate()
        );
        $fastSales = CreditNoteResource::collection(
            $credit->fastSales()->applyFilters()->orderBy('id', 'desc')->paginate()
        );

        $notes = $sales->merge($fastSales);

        return response()->json([
            'notes' => $notes
        ]);
    }
}
