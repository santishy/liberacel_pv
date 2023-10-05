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
            return ExpenseResource::collection(Expense::applyFilters()->paginate(25));
        }
        return view('reports.expenses.index');
    }
}
