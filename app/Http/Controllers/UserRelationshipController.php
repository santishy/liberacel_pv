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

        /* $credentials = $request->validate([
            'username' => 'required|min:4',
            'password' => 'required',
            'model' => 'required',
            'id' => "required|exists:App\Models\\$request->model,id"
        ], [
            'username.required' => 'El campo nombre de usuario es requerido.',
            'username.min' => "el campo nombre de usuario como minimo tiene que tener 4 letras.",
            "model.required" => "Modelo requerido, hable con su proovedor.",
            "id.required" => "Id requerido, hable con su proveedor.",
            "password.required" => "El campo contraseña es requerido."

        ]); */

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
