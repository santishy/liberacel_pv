<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseReportController extends Controller
{
    public function index()
    {
        if (request()->wantsJson()) {
            return Expense::applyFilters()->paginate(25);
        }
        return view('reports.expenses.index');
    }
}
