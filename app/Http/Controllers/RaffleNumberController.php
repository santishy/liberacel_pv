<?php

namespace App\Http\Controllers;

use App\Facades\InventoryContext;
use App\Http\Resources\RaffleNumberResource;
use App\Http\Traits\HasAdministrator;
use App\Models\Raffle;
use App\Models\RaffleNumber;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Http\Request;

class RaffleNumberController extends Controller
{
    use HandlesAuthorization, HasAdministrator;

    public function index()
    {
        $this->authorize('viewAny', new RaffleNumber);
        if (request()->wantsJson()) {
            $raffleNumbers = RaffleNumber::query()
                ->with('saleable', 'raffle')
                ->applyFilters()
                ->whereHas('raffle', function ($query) {
                    $query->where('inventory_id', InventoryContext::id());
                });
            if (! request()->filled('filter.byRaffle')) {
                $mostRecentRaffleId = Raffle::where('inventory_id', InventoryContext::id())->latest('start_date')->value('id');
                $raffleNumbers->byRaffle($mostRecentRaffleId);
            }

            return RaffleNumberResource::collection(
                $raffleNumbers->paginate(25)
            );
        }

        return view('raffle-numbers.index');
    }

    public function edit(RaffleNumber $raffleNumber)
    {
        $this->authorize('update', $raffleNumber);

        return view('raffle-numbers.edit', compact('raffleNumber'));
    }

    public function update(RaffleNumber $raffleNumber, Request $request)
    {

        $data = $request->validate([
            'status' => 'required|in:available,assigned',
        ]);
        $raffleNumber->status = $data['status'];
        if ($data['status'] === 'available') {
            $this->authorize('release', $raffleNumber);
            $raffleNumber->saleable()->dissociate();
        } else {
            $this->authorize('update', $raffleNumber);
        }
        $raffleNumber->save();

        return RaffleNumberResource::make($raffleNumber);
    }
}
