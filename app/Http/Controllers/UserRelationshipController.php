<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserRelationshipController extends Controller
{
    public function store(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'model' => 'required',
            'id' => "required|exists:App\Models\\$request->model,id"
        ]);
        $user = User::where('email', $credentials['email'])->first();
        if(!Hash::check( $credentials['password'],optional($user)->password)){
            return response()->json(['errors' => ['error' => 'Tu email|password es incorrecto.' ]],422);
        }
        $model = str::of( $request->model);
        $user->{lcfirst($model)}()->associate("App\Models\\$model->ucfirst"::find($request->id));
        session()->forget('fast-sale');
        
    }
}
