<?php

namespace App\Models\onlineExam;

use App\Models\Classes;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlineExam extends Model
{
    use HasFactory;

    
    public function question_group()
    {
        return $this->belongsTo(QuestionGroup::class, 'question_group', 'id');
    }


    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }


    public function classes()
    {
        return $this->belongsTo(Classes::class, 'class_id', 'id');
    }


    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }


    public function online_exam_type()
    {
        return $this->belongsTo(OnlineExamType::class, 'type_id', 'id');
    }

    public function question_list()
    {
        return $this->hasMany(OnlineExamQstList::class, 'id');
    }
    public function option_list()
    {
        return $this->hasMany(QuestionBankAnswer::class, 'id');
    }

    public function question_bank()
    {
        return $this->belongsTo(QuestionBank::class);
    }


    // public function question_bank_answer()
    // {
    //     return $this->belongsTo(QuestionBankAnswer::class);
    // }
}
