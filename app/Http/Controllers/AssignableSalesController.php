<?php

namespace App\Http\Controllers;

use App\Facades\InventoryContext;
use App\Http\Resources\AssignableSaleResource;
use App\Models\RaffleNumber;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AssignableSalesController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $this->authorize("assign", new RaffleNumber());
        $request->validate(['type' => ["required", Rule::in(["FastSale", "Sale"])]]);
        $modelName = $request->type;
        $model = "App\Models\\" . $modelName;

        $query = $model::with('user')->whereInventoryId(InventoryContext::id())
            ->where(function ($query) {
                $query->whereStatus('pending')
                    ->orWhere('status', 'completed');
            })->today()->whereDoesntHave('raffleNumber');

        return  AssignableSaleResource::collection($query->latest("id")->paginate(25));
    }
}
