<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class GeneralReportController extends Controller
{
    public function index()
    {
        // $user = Auth::user();
        Gate::allowIf(fn ($user) => $user->hasRole("admin"));

        return view('reports.index');
    }
}
