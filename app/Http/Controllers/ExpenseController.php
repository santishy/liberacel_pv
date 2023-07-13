<?php

namespace App\Http\Controllers;

use App\Http\Resources\ExpenseResource;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', new Expense);
        if (request()->wantsJson())
            return ExpenseResource::collection(Expense::paginate(5));
        return view('expenses.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', new Expense());
        return view('expenses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', new Expense);
        $data = $request->validate(
            [
                'concept' => ['required'],
                'amount' => ['required', 'numeric']
            ],
            [
                'concept.required' => 'El concepto es requerido.',
                'amount.required' => 'El importe es requerido.',
                'amount.numeric' => 'El campo amount debe ser numerico'
            ]
        );
        $expense = Expense::create(
            $data
        );
        return response()->json([
            'data' =>   [
                'created_at' => $expense->created_at->format('Y-m-d H:m:s'),
                'concept' => $expense->concept,
                'amount' => $expense->amount
            ]
        ]);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        $this->authorize('update', $expense);
        return view('expenses.edit', compact('expense'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        $this->authorize('update', $expense);
        $data = $request->validate([
            "amount" => "numeric",
            "concept" => "string"
        ]);
        $expense->update($data);

        return response()->json([
            'data' => $expense
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        $this->authorize('delete', $expense);
        $expense->delete();
        return response()->json(null, 204);
    }
}
