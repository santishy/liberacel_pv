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
        if (request()->wantsJson()) {
            $user = User::find(request('user_id'));
            $query = $user->fastSaleCommission()->applyFilters();
            $commissions  = CommissionResource::collection(
                $query->paginate()
            );
            return response()->json([
                'commissions' => $commissions,
                'total' => $query->sum('amount')
            ]);
        }
        $users = User::all();
        return view('commissions.index', compact('users'));
    }
}
