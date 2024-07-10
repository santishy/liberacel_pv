<?php

namespace App\Http\Controllers;

use App\Events\SaleTransactionProcessed;
use App\Http\Requests\StoreUserRelationshipRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class UserRelationshipController extends Controller
{

    public function store(StoreUserRelationshipRequest $request)
    {
        $model = $this->getModel($request);

        $this->authorize('restore', $model);

        $user = $model->checkCredentials(request('username'), request('password'));

        $model->toggleUser($user);

        if ($model->hasCredit()) {
            $model->update(['status' => 'completed']);
            $inverse = -1;
            $model->handleCredit($model->factors["completed"] * $inverse);
            SaleTransactionProcessed::dispatch($model);
        }

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
