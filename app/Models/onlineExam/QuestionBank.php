<?php

namespace App\Models\onlineExam;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\onlineExam\QuestionGroup;

class QuestionBank extends Model
{
    use HasFactory;

    public function questionGroup()
    {
        return $this->belongsTo(QuestionGroup::class, 'question_group');
    }

    public function question_list()
    {
        return $this->hasMany(OnlineExamQstList::class, 'question_bank_id', 'id');
    }

    public function question_bank_answer()
    {
        return $this->hasMany(QuestionBankAnswer::class, 'question_bank_id', 'id');
    }
}
