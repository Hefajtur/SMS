<?php

namespace App\Services\transaction;
use App\Models\Income;
use DataTables;
use App\helper\FileUpload;
/**
 * Class IncomeService.
 */
class IncomeService
{

    public function index(){

        $data = Income::with('incomeExpenses')->latest()->get();
        return DataTables::of($data)
        ->addIndexColumn()

        ->addColumn('IncomeHead', function ($data) {
            return $data->incomeExpenses->name;
        })

        ->addColumn('document', function ($data) {
            return  '<img src="' . $data->document . '" alt="" style="height: 60px; width: 60px">';
        })

            ->addColumn('action', function($data){
                $actionBtn = '<a href="javascript:void(0)" id="income_edit" income_id="'.$data->id.'" class="btn btn-success btn-sm"><i class="fa-solid fa-pen-to-square"></i></a> <a href="javascript:void(0)" id="income_delete" income_id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>';
                return $actionBtn;
            })

            
            ->rawColumns(['action','document'])
            ->make(true);
    }



    public function create($request)
    {

        $income = new Income();
        $income->name = $request->name;
        $income->income_expenses_id = $request->income_expenses_id;
        $income->date = $request->date;
        $income->invoice_num = $request->invoice_num;
        $income->amount = $request->amount;
        $income->document = FileUpload::imageUpload($request->file('document'), 'transaction/');
        $income->description = $request->description;
        $income->save();

        $this->response['success'] = true;
        return $this->response;
    }
    

    public function update($request){
      
        $income = Income::find($request->id);
        $income->name = $request->name;
        $income->income_expenses_id = $request->income_expenses_id;
        $income->date = $request->date;
        $income->invoice_num = $request->invoice_num;
        $income->amount = $request->amount;
        $income->document = FileUpload::imageUpload($request->file('document'), 'transaction/', isset($income->id) ? Income::find($income->id)->document : null);
        $income->description = $request->description;
        $income->save();
        $this->response['success'] = true;
        return $this->response;

    }


    public function destroy($income){
        
        $delete_Income = Income::find($income->id);
        $delete_Income->delete();

        $this->response['success'] = true;
        return $this->response;
    }

}
