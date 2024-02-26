<?php

namespace App\Models\onlineExam;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlineExamQstList extends Model
{
    use HasFactory;

    // Desion
    // public function questionList()
    // {
    //     return $this->belongsTo(OnlineExam::class, 'id', 'id');
    // }



    public function ans_option()
    {
        return $this->hasMany(QuestionBankAnswer::class, 'question_bank_id', 'id');
    }


}
