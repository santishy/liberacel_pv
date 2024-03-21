<?php

namespace App\Http\Controllers;

use App\Events\SaleTransactionProcessed;
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
use Illuminate\Validation\ValidationException;
use Facade\Ignition\QueryRecorder\Query;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Environment\Console;

class SaleController extends Controller
{
    use HasTransaction;
    private $factors = [
        "completed" => -1,
        "pending" => 1,
    ];
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

        // ver la primera validacion que hay dentro de este evento refernte a status ;)
        TransactionComplete::dispatch($sale, $this->factors[$fields['status']]);


        $this->buildSaleIDSession($fields, $sale);

        $sale->update($fields);

        if ($sale->is_credit && $sale->client_id) {
            $inverse = -1;
            $sale->handleCredit($this->factors[$sale->status] * $inverse);
        }

        //Commission
        SaleTransactionProcessed::dispatch($sale);

        return response()->json([
            'sale_status' => $sale->status,
            'total' => $sale->total
        ]);
    }

    public function update(Sale $sale, Request $request)
    {

        $data = $request->validate([
            'status' => 'in:completed,cancelled,pending',
            "is_credit" => "nullable|boolean",
            "client_id" => "nullable|exists:clients,id",
            "total" => "numeric",
        ]);

        if ($data['is_credit']) {
            if (!$sale->client_id) {
                throw ValidationException::withMessages([
                    'client_id' => 'El campo cliente es requerido'
                ]);
            }
        }
        $sale->update($data);
        //$this->authorize('update', $sale);

        return new TransactionResource($sale->load('client'));
    }

    public function destroy(Sale $sale)
    {
        $this->authorize('delete', $sale);

        if ($sale->status != 'completed') {
            //$saleDeleted = $sale->delete();
            $saleDeleted = $sale->update(["status" => "cancelled"]);
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
    private function buildSaleIDSession($fields, $sale)
    {
        if ($fields['status'] == 'completed') {
            request()->session()->forget('sale_id');
        } elseif ($fields['status'] == 'pending') {
            request()->session()->put('sale_id', $sale->id);
        }
    }
}
