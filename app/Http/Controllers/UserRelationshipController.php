<?php

namespace App\Http\Controllers;

use App\Events\SaleTransactionProcessed;
use App\Events\TransactionComplete;
use App\Http\Requests\StoreUserRelationshipRequest;
use App\Models\Raffle;

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
            $model->handleCredit($model->factors['completed'] * $inverse);
            if ($request->model === 'Sale') {
                TransactionComplete::dispatch($model, $model->factors['completed']);
            }
            SaleTransactionProcessed::dispatch($model);
        }

        $model->deleteTheSessionID();
        $activeRaffle = (bool) Raffle::activeForInventory($model->inventory_id);
        return response()->json([
            'sale' => $model,
            'hasActiveRaffle' => $activeRaffle,
        ]);
    }

    public function getModel($request)
    {
        $model = str::of($request->model);
        $model = app("App\Models\\$model->ucfirst")->find($request->id);

        return $model;
    }
}
