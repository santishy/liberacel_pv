<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImpersonationController extends Controller
{
    public function store()
    {
        if (Auth::user()->hasRole('admin')) {
            session(['impersonation_id' => Auth::user()->id]);
            Auth::loginUsingId(request('user_id'));
            return redirect()->back();
        }
        return abort(403);
    }

    public function destroy()
    {
        Auth::loginUsingId(session('impersonation_id'));
        session()->forget('impersonation_id');
        return redirect()->back();
    }
}
