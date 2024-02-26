<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Income;
use App\Models\IncomeExpense;
use App\Services\transaction\IncomeService;
use App\Http\Requests\transaction\incomeRequest;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $incomeService= new IncomeService();
            return ($incomeService -> index());
         
          }
        return view('dashboard.transaction.income.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.transaction.income.create',[
            'IncomeExpenses' => IncomeExpense::where('type', '=', '1')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(incomeRequest $request)
    {
        $validator = $request->validated();
        $incomeService= new IncomeService();
        return $incomeService->create($request); 
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Income $income)
    {
        return view('dashboard.transaction.income.edit', [

            "incomes" => $income,
            'IncomeExpenses'  => IncomeExpense::where('type', '=', 'Income')->get(),
          
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(incomeRequest $request)
    {
        $validator = $request->validated();
        $incomeService= new IncomeService();
        return $incomeService->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Income $income)
    {
        $incomeService= new IncomeService();
        return $incomeService->destroy($income);
    }
}
