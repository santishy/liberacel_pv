<?php

namespace App\Http\Controllers;

use App\Http\Resources\RaffleNumberResource;
use Illuminate\Http\Request;
use App\Models\RaffleNumber;

class RaffleNumberController extends Controller
{
    public function index()
    {
        if (request()->wantsJson()) {
            return RaffleNumberResource::collection(
                RaffleNumber::query()
                    ->forActiveRaffle()
                    ->with('saleable')
                    ->applyFilters()
                    ->paginate(25)
            );
        }

        return view('raffle-numbers.index');
    }

    public function edit(RaffleNumber $raffleNumber)
    {
        return view('raffle-numbers.edit', compact('raffleNumber'));
    }
    public function update(RaffleNumber $raffleNumber,Request $request)
    {
        $data = $request->validate([
            'status' => 'required|in:available,assigned',
        ]);
        $raffleNumber->status = $data['status'];
        if($data['status'] === 'available' ) {
            $raffleNumber->saleable()->dissociate();
        }
        $raffleNumber->save();

        return RaffleNumberResource::make($raffleNumber);
    }
}
