<?php

namespace App\Http\Controllers;

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
            $commissions  = $user->fastSales()->with('commission')->paginate();
            //$commissions = Commission::query()->applyFilters()->paginate(50);
            return response()->json([
                'commissions' => $commissions
            ]);
        }
        $users = User::all();
        return view('commissions.index', compact('users'));
    }
}
