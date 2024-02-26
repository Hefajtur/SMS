<?php

namespace App\Services\transaction;
use App\Models\Expense;
use DataTables;
use App\helper\FileUpload;
/**
 * Class ExpenseService.
 */
class ExpenseService
{

    public function index(){

        $data = Expense::with('incomeExpenses')->latest()->get();
        return DataTables::of($data)
        ->addIndexColumn()

        ->addColumn('ExpenseHead', function ($data) {
            return $data->incomeExpenses->name;
        })

        ->addColumn('document', function ($data) {
            return  '<img src="' . $data->document . '" alt="" style="height: 60px; width: 60px">';
        })

            ->addColumn('action', function($data){
                $actionBtn = '<a href="javascript:void(0)" id="expense_edit" expense_id="'.$data->id.'" class="btn btn-success btn-sm"><i class="fa-solid fa-pen-to-square"></i></a> <a href="javascript:void(0)" id="expense_delete" expense_id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>';
                return $actionBtn;
            })

            
            ->rawColumns(['action','document'])
            ->make(true);
    }


    public function create($request)
    {

        $expense = new Expense();
        $expense->name = $request->name;
        $expense->income_expenses_id = $request->income_expenses_id;
        $expense->date = $request->date;
        $expense->invoice_num = $request->invoice_num;
        $expense->amount = $request->amount;
        $expense->document = FileUpload::imageUpload($request->file('document'), 'transaction/');
        $expense->description = $request->description;
        $expense->save();

        $this->response['success'] = true;
        return $this->response;
    }

    public function update($request){
      
        $expense = Expense::find($request->id);
        $expense->name = $request->name;
        $expense->income_expenses_id = $request->income_expenses_id;
        $expense->date = $request->date;
        $expense->invoice_num = $request->invoice_num;
        $expense->amount = $request->amount;
        $expense->document = FileUpload::imageUpload($request->file('document'), 'transaction/', isset($expense->id) ? Expense::find($expense->id)->document : null);
        $expense->description = $request->description;
        $expense->save();
        $this->response['success'] = true;
        return $this->response;

    }


    public function destroy($expense){
        
        $delete_expense= Expense::find($expense->id);
        $delete_expense->delete();

        $this->response['success'] = true;
        return $this->response;
    }


}
