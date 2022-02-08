<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserCommissionsController extends Controller
{
    public function index()
    {
        if (request()->wantsJson()) {
            if(request()->has('user_id')){
                $user = User::find(request('user_id'));
                $commissions  = $user->with('fastSales.commission');
                return $commissions;
            }
        }
        $users = User::all();
        return view('commissions.index', compact('users'));
    }
}
