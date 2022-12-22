<?php

namespace App\Http\Controllers;

use App\Models\Refund;
use Illuminate\Http\Request;

class RefundController extends Controller
{
    public function index(){

    }
    public function create(){
        return view('refunds.create');
    }

    public function store(){}

    public function edit(){}

    public function update(Request $request,Refund $refund){}


}
