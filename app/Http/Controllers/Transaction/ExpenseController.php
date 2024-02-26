<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\IncomeExpense;
use App\Services\transaction\ExpenseService;
use App\Http\Requests\transaction\ExpenseRequest;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $expenseService= new ExpenseService();
            return ($expenseService -> index());
         
          }
        return view('dashboard.transaction.expense.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.transaction.expense.create',[
            'IncomeExpenses' => IncomeExpense::where('type', '=', '2')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExpenseRequest $request)
    {
        $validator = $request->validated();
        $expenseService= new ExpenseService();
        return $expenseService->create($request); 
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        return view('dashboard.transaction.expense.edit', [

            "expense" => $expense,
            'IncomeExpenses'  => IncomeExpense::where('type', '=', 'Expense')->get(),
          
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExpenseRequest $request)
    {
        $validator = $request->validated();
        $expenseService= new ExpenseService();
        return $expenseService->update($request); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        $expenseService= new ExpenseService();
        return $expenseService->destroy($expense);
    }
}
