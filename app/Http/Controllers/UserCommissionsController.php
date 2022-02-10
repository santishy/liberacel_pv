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

            $commissions  = User::with('fastSales')->paginate();
            //$commissions = Commission::query()->applyFilters()->paginate(50);
            return response()->json([
                'commissions' => $commissions
            ]);
        }
        $users = User::all();
        return view('commissions.index', compact('users'));
    }
}
