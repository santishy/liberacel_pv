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
            $commissions  = CommissionResource::collection(
                $user->fastSaleCommission()->applyFilters()->paginate()
            );
            return response()->json([
                'commissions' => $commissions
            ]);
        }
        $users = User::all();
        return view('commissions.index', compact('users'));
    }
}
