<?php

namespace App\Models\onlineExam;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionBankAnswer extends Model
{
    use HasFactory;

    public function qst_ans()
    {
        return $this->belongsTo(QuestionBank::class, 'question_bank_id', 'id');
    }



}
