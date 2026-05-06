<?php

namespace App\Http\Controllers;

use App\Http\Resources\RaffleNumberResource;
use Illuminate\Http\Request;
use App\Models\RaffleNumber;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Http\Traits\HasAdministrator;
use App\Facades\InventoryContext;

class RaffleNumberController extends Controller
{
    use HandlesAuthorization, HasAdministrator;

    public function index()
    {
        $this->authorize('viewAny', new RaffleNumber);
        if (request()->wantsJson()) {
            return RaffleNumberResource::collection(
                RaffleNumber::query()
                    ->forActiveRaffle()
                    ->with('saleable')
                    ->applyFilters()
                    ->whereHas('raffle', function ($query) {
                        $query->where('inventory_id', InventoryContext::id());
                    })
                    ->paginate(25)
            );
        }

        return view('raffle-numbers.index');
    }

    public function edit(RaffleNumber $raffleNumber)
    {
        $this->authorize('update', $raffleNumber);
        return view('raffle-numbers.edit', compact('raffleNumber'));
    }
    public function update(RaffleNumber $raffleNumber,Request $request)
    {
        
        $data = $request->validate([
            'status' => 'required|in:available,assigned',
        ]);
        $raffleNumber->status = $data['status'];
        if($data['status'] === 'available' ) {
            $this->authorize('release', $raffleNumber);
            $raffleNumber->saleable()->dissociate();
        }else{
            $this->authorize('update', $raffleNumber);
        }
        $raffleNumber->save();
        return RaffleNumberResource::make($raffleNumber);
    }
}
