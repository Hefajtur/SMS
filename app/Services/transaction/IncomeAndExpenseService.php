<?php

namespace App\Services\transaction;
use App\Models\IncomeExpense;
use DataTables;
/**
 * Class IncomeAndExpenseService.
 */
class IncomeAndExpenseService
{
    public function index(){

        $data = IncomeExpense::latest()->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function($data){
               if($data -> status == 1 ){
                return "<span class='badge_status_act'> Active </span>";
               }else{
                return "<span class='badge_status_inact'> Inactive </span>";
               }
            })
            ->addColumn('type', function($data){
                if($data -> type == 1 ){
                 return "Income";
                }else{
                 return "Expense";
                }
             })
            ->addColumn('action', function($data){
                $actionBtn = '<a href="javascript:void(0)" id="incomeandexpense_edit" incomeandexpense_id="'.$data->id.'" class="btn btn-success btn-sm"><i class="fa-solid fa-pen-to-square"></i></a> <a href="javascript:void(0)" id="incomeandexpense_delete" incomeandexpense_id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>';
                return $actionBtn;
            })
            ->rawColumns(['action', 'status', 'type'])
            ->make(true);
    }

    public function create($request){

       
        $IncomeExpense = new IncomeExpense();
        $IncomeExpense ->name= $request->name;
        $IncomeExpense ->type= $request->type;
        $IncomeExpense ->status = $request->status;
        $IncomeExpense->save();

        $this->response['success'] = true;
        return $this->response;

    }

    public function update($request, $id){
      
        $IncomeExpense = IncomeExpense::find($id);
        $IncomeExpense ->name= $request->name;
        $IncomeExpense ->type= $request->type;
        $IncomeExpense ->status = $request->status;
        $IncomeExpense->save();
        $this->response['success'] = true;
        return $this->response;

    }

    public function destroy($id){
        
        $delete_IncomeExpense = IncomeExpense::find($id);
        $delete_IncomeExpense->delete();

        $this->response['success'] = true;
        return $this->response;
    }
}
