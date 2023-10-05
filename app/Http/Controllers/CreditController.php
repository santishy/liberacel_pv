<?php

namespace App\Http\Controllers;

use App\Http\Resources\CreditResource;
use App\Models\Credit;
use Illuminate\Http\Request;

class CreditController extends Controller
{
    function index()
    {
        if (request()->wantsJson()) {
            return CreditResource::collection(
                Credit::with('client')->applyFilters()->paginate(25)
            );
        }
        return view('credits.index');
    }

    function store(Request $request)
    {
    }
    function update(Request $request, Credit $credit)
    {
    }

    function show(Credit $credit)
    {
    }
    function destroy(Credit $credit)
    {
    }
}