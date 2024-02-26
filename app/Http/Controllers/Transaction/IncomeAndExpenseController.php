<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IncomeExpense;
use App\Models\Cost;
use App\Services\transaction\IncomeAndExpenseService;
use App\Http\Requests\transaction\IncomeAndExpenseRequest;
class IncomeAndExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $IncomeAndExpenseService= new IncomeAndExpenseService();
            return ($IncomeAndExpenseService -> index());
                      
          }
        return view('dashboard.transaction.incomeAndexpense.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.transaction.incomeAndexpense.create',[
            'costs' => Cost::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(IncomeAndExpenseRequest $request)
    {
        $validator = $request->validated();
        $IncomeAndExpenseService= new IncomeAndExpenseService();
        return $IncomeAndExpenseService -> create($request); 
    }

    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $incomeExpense = IncomeExpense::find($id);
        return view('dashboard.transaction.incomeAndexpense.edit', [

            'incomeExpense' => $incomeExpense,  
            'costs' => Cost::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(IncomeAndExpenseRequest $request,  $id)
    {
        $validator = $request->validated();
        $IncomeAndExpenseService= new IncomeAndExpenseService();
        return $IncomeAndExpenseService -> update($request, $id); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $IncomeAndExpenseService= new IncomeAndExpenseService();
        return $IncomeAndExpenseService -> destroy($id); 

    }
}
