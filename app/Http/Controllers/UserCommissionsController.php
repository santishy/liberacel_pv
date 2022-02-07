<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserCommissionsController extends Controller
{
    public function index()
    {
        if(request()->wantsJson()){
            if(request()->has('id')){
                $user = User::find(request('id'));
                $commissions  = $user->load('fastSales.commission');
                dd($commissions);
            }
        }
        $users = User::all();
        return view('commissions.index',compact('users'));
    }
}
