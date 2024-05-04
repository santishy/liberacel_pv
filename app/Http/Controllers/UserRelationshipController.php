<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRelationshipRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserRelationshipController extends Controller
{
    public function store(StoreUserRelationshipRequest $request)
    {
        $model = $this->getModel($request);
        /**
         * authorize ... mandamos el model al metodo update y lo adaptaoms en el policy correspondiente
         */
        $this->authorize('restore', $model);

        $user = User::where('username', $request->username)->first();

        if (!Hash::check($request->password, optional($user)->password)) {
            return response()
                ->json(
                    ['errors' => ['error' => 'Nombre de usuario ó contraseña, incorrectos.']],
                    422
                );
        }



        if ($model->user()->exists()) {
            $model->user()->dissociate();
            //$model->save();
        }
        $model->user()->associate($user);
        $model->save();

        if (session()->has('fast-sale')) {
            session()->forget('fast-sale');
        }

        return response()->json([
            'sale' => $model,
        ]);
    }
    public function getModel($request)
    {
        $model = str::of($request->model);
        $model = app("App\Models\\$model->ucfirst")->find($request->id);
        return $model;
    }
}
