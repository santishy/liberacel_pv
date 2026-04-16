<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveRaffleRequest;
use App\Http\Resources\RaffleResource;
use App\Jobs\GenerateRaffleNumbers;
use App\Models\Raffle;
use Illuminate\Http\Request;

class RaffleController extends Controller
{
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            // se pueden aplicar applifilters() después si es que se requiere.
            return RaffleResource::collection(Raffle::paginate(25));
        }

        return view('raffles.index');
    }

    public function create()
    {
        return view('raffles.create');
    }

    public function show(Raffle $raffle)
    {
        if (request()->wantsJson()) {
            return RaffleResource::make($raffle);
        }

    }

    public function edit(Raffle $raffle)
    {
        $raffle = RaffleResource::make($raffle);

        return view('raffles.edit', compact('raffle'));
    }

    public function store(SaveRaffleRequest $request)
    {
        $raffle = Raffle::create($request->validated());
        GenerateRaffleNumbers::dispatch($raffle);
        return RaffleResource::make($raffle);
    }

    public function update(SaveRaffleRequest $request, Raffle $raffle)
    {
        $data = $request->validated();
        $raffle->update($data);

        return RaffleResource::make($raffle->fresh());
    }

    public function destroy(Raffle $raffle)
    {
        $raffle->update(['status' => 'finished']);

        return response()->json([], 204);
    }
}
