<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\IncomeExpense;

class Expense extends Model
{
    use HasFactory;

    protected $fillable=['name','income_expenses_id','date','invoice_num','amount','document','description'];

    public function incomeExpenses()
    {
        return $this->belongsTo(IncomeExpense::class, 'income_expenses_id');
    }
}
