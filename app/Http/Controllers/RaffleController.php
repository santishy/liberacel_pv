<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveRaffleRequest;
use App\Http\Resources\RaffleResource;
use App\Jobs\GenerateRaffleNumbers;
use App\Models\Raffle;
use Illuminate\Http\Request;
use App\Facades\InventoryContext;

class RaffleController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('viewAny', new Raffle);
        if ($request->wantsJson()) {
            return RaffleResource::collection(
                Raffle::query()->where('inventory_id',InventoryContext::id())->paginate(25)
            );
        }

        return view('raffles.index');
    }

    public function create()
    {
        $this->authorize('create', new Raffle);
        return view('raffles.create');
    }

    public function show(Raffle $raffle)
    {
        $this->authorize('view', $raffle);
        if (request()->wantsJson()) {
            return RaffleResource::make($raffle);
        }

    }

    public function edit(Raffle $raffle)
    {
        $this->authorize('update', $raffle);
        $raffle = RaffleResource::make($raffle);

        return view('raffles.edit', compact('raffle'));
    }

    public function store(SaveRaffleRequest $request)
    {
        $this->authorize('create', new Raffle);
        $raffle = Raffle::create($request->validated());
        GenerateRaffleNumbers::dispatch($raffle);
        return RaffleResource::make($raffle);
    }

    public function update(SaveRaffleRequest $request, Raffle $raffle)
    {
        $this->authorize('update', $raffle);
        $data = $request->validated();
        $raffle->update($data);

        return RaffleResource::make($raffle->fresh());
    }

    public function destroy(Raffle $raffle)
    {
        $this->authorize('delete', $raffle);
        $raffle->update(['status' => 'finished']);

        return response()->json([], 204);
    }
}
