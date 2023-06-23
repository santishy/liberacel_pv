<?php

namespace App\Http\Controllers;

use App\Events\TransactionComplete;
use App\Http\Requests\StoreSaleRequest;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Resources\TransactionResource;
use App\Http\Responses\ReportResponse;
use App\Http\Traits\HasTransaction;
use App\Models\Category;
use App\Models\Inventory;
use App\Models\Sale;
use Facade\Ignition\QueryRecorder\Query;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Environment\Console;

class SaleController extends Controller
{
    use HasTransaction;

    public function index()
    {
        $this->authorize('viewAny', new Sale);

        //return response()->json(['ok' => request('filter')]);

        if (request()->wantsJson()) {
            return new ReportResponse(Sale::query());
        }

        $inventories = Inventory::all('id', 'name');

        return view('transactions.index', [
            'uri' => '/sales',
            'inventories' => $inventories,
            'name' => 'Ventas'
        ]);
    }
    public function create()
    {
        $this->authorize('create', new Sale);
        $sale = Sale::with('client')->where('id', session('sale_id'))->first();
        $inventories = Inventory::all();
        $categories = Category::all();
        return view('sales.create', [
            'sale' => $sale ? TransactionResource::make($sale->load('products')) : null,
            'inventories' => $inventories,
            'categories' => $categories
        ]);
    }



    public function store(StoreSaleRequest $request, Sale $sale)
    {
        $this->authorize('create', $sale);

        $fields = $request->validated();

        $factors = [
            "completed" => -1,
            "pending" => 1
        ];

        if ($fields['status'] == 'completed') {
            //$factor = -1;
            request()->session()->forget('sale_id');
        } elseif ($fields['status'] == 'pending') {
            //$factor = 1;
            request()->session()->put('sale_id', $sale->id);
        }


        // ver la primera validacion que hay dentro de este evento refernte a status ;)
        TransactionComplete::dispatch($sale, $factors[$fields['status']]);

        $sale->update($fields);

        if ($fields['is_credit'] && $sale->client_id) {
            $sale->handleCredit($factors[$fields['status']]);
        }

        return response()->json([
            'sale_status' => $sale->status
        ]);
    }

    public function destroy(Sale $sale)
    {
        $this->authorize('delete', $sale);

        if ($sale->status != 'completed') {
            $saleDeleted = $sale->delete();
            session()->forget('sale_id');
            return response()->json(['saleDeleted' => $saleDeleted]);
        }
        $this->deleteSessionVariable('sale_id');
        TransactionComplete::dispatch($sale, request('factor'));
        $sale->status = 'cancelled';
        $sale->save();
        return response()->json([
            'status' => $sale->status
        ]);
    }
}
