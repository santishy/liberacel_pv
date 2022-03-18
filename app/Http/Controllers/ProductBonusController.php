<?php

namespace App\Http\Controllers;

use App\Models\ProductBonus;
use Illuminate\Http\Request;

class ProductBonusController extends Controller
{
    public function index(){
        $productBonus = ProductBonus::paginate();
        return view('product-bonus.index',compact('productBonus'));
    }
    
    public function store(){

    }
}
