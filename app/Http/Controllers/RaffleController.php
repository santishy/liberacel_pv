<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveRaffleRequest;
use App\Http\Resources\RaffleResource;
use App\Jobs\GenerateRaffleNumbers;
use App\Models\Raffle;
use Illuminate\Http\Request;

class RaffleController extends Controller
{
    public function create()
    {

        return view('raffles.create');
    }
    public function store(SaveRaffleRequest $request)
    {
        $raffle = Raffle::create($request->validated());
        GenerateRaffleNumbers::dispatch($raffle);
        return  RaffleResource::make($raffle);
    }
}
