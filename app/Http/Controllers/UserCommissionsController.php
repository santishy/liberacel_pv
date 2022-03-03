<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommissionResource;
use App\Models\Commission;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserCommissionsController extends Controller
{
    public function index()
    {

        // if (request()->wantsJson()) {
        //     // $this->authorize('viewAny',new Commission);
        //     $user = User::find(request('user_id'));
        //     $query = $user->fastSaleCommission()->applyFilters();
        //     $commissions  = CommissionResource::collection(
        //         $query->paginate()
        //     );
        //     $total = $query->sum('amount');
        //     return response()->json([
        //         'commissions' => $commissions,
        //         'totalWithFormat' => "$" . number_format($total, 2),
        //         'total' => $total,
        //     ]);
        // }
        $users = User::all();
        return view('commissions.index', compact('users'));
    }
    /**
     * 
     */
    public function update(Request $request, Commission $commission)
    {
        $this->authorize('update', $commission);
        $request->validate([
            'amount' => 'required|numeric|min:0',
        ]);
        $oldComission = $commission->amount;
        $commission->amount = $request->amount;
        $commission->save();
        return response()->json([
            'oldCommission' => $oldComission,
            'updatedCommission' => $commission->fresh()->amount,
        ]);
    }
}
