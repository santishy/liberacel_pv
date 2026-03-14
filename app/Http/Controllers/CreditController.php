<?php

namespace App\Http\Controllers;

use App\Http\Resources\CreditResource;
use App\Models\Credit;
use Illuminate\Http\Request;

class CreditController extends Controller
{
    public function index()
    {

        $this->authorize('viewAny', new Credit);

        if (request()->wantsJson()) {
            return CreditResource::collection(
                Credit::with('client')->applyFilters()->paginate(25)
            );
        }

        return view('credits.index');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'model' => ['request'],
        ]);
    }

    public function update(Request $request, Credit $credit) {}

    public function show(Credit $credit) {}

    public function destroy(Credit $credit) {}
}
