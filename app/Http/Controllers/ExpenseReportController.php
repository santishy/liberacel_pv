<?php

namespace App\Http\Controllers;

use App\Http\Resources\ExpenseResource;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseReportController extends Controller
{
    public function index()
    {
        if (request()->wantsJson()) {
            $expenses = Expense::applyFilters();
            $data = [
                "data" => ExpenseResource::collection($expenses->paginate(25))
            ];
            if (request('page') == 1) {
                $data['total'] = $expenses->sum('amount');
            }
            return response()->json($data);
        }
        return view('reports.expenses.index');
    }
}
